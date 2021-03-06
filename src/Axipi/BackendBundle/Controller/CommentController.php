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
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $parameterBag->set('category', $id);
        } else if(null !== $id) {
            $comment = $this->commentManager->getOne(['id' => $id]);
            if($comment) {
                $parameterBag->set('comment', $comment);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameterBag);
            case 'read':
                return $this->readAction($request, $parameterBag);
            case 'update':
                return $this->updateAction($request, $parameterBag);
            case 'delete':
                return $this->deleteAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag)
    {
        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['widgetParameterName' => 'page']);
        $pagination = $paginator->paginate(
            $this->commentManager->getList([]),
            $request->query->getInt('page', 1),
            10
        );

        $parameterBag->set('comments', $pagination);

        return $this->render('AxipiBackendBundle:Comment:index.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        return $this->render('AxipiBackendBundle:Comment:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(CommentType::class, $parameterBag->get('comment'), [
            'comment' => $parameterBag->get('comment'),
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
                return $this->redirectToRoute('axipi_backend_comment', ['action' => 'read', 'id' => $parameterBag->get('comment')->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Comment:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->commentManager->remove($parameterBag->get('comment'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_comment', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Comment:delete.html.twig', $parameterBag->all());
    }
}
