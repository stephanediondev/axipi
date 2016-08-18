<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\CommentManager;
use Axipi\CoreBundle\Manager\ItemManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\CommentType;
use Axipi\CoreBundle\Entity\Comment;

class CommentController extends AbstractController
{
    protected $commentManager;

    protected $itemManager;

    public function __construct(
        CommentManager $commentManager,
        ItemManager $itemManager
    ) {
        $this->commentManager = $commentManager;
        $this->itemManager = $itemManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        if(!$this->isGranted('ROLE_COMMENTS')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $parameters->set('category', $id);
        } else if(null !== $id) {
            $comment = $this->commentManager->getOne(['id' => $id]);
            if($comment) {
                $parameters->set('comment', $comment);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_comments', []);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters);
            case 'read':
                return $this->readAction($request, $parameters, $id);
            case 'update':
                return $this->updateAction($request, $parameters, $id);
            case 'delete':
                return $this->deleteAction($request, $parameters, $id);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_comments', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['widgetParameterName' => 'page']);
        $pagination = $paginator->paginate(
            $this->commentManager->getList([]),
            $request->query->getInt('page', 1),
            10
        );

        $parameters->set('comments', $pagination);

        return $this->render('AxipiBackendBundle:Comment:index.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('AxipiBackendBundle:Comment:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(CommentType::class, $parameters->get('comment'), [
            'comment' => $parameters->get('comment'),
            'comments' => [
                'Page' => $this->commentManager->getList(['category' => 'page']),
                'Widget' => $this->commentManager->getList(['category' => 'widget'])
            ],
            'zones' => $this->itemManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->commentManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_comments', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Comment:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->commentManager->remove($parameters->get('comment'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_comments', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Comment:delete.html.twig', $parameters->all());
    }
}
