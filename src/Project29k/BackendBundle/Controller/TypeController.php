<?php

namespace Project29k\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

use Project29k\CoreBundle\Controller\AbstractController;

use Project29k\BackendBundle\Manager\TypeManager;
use Project29k\CoreBundle\DependencyInjection\RenderTrait;
use Project29k\CoreBundle\Entity\Type;

class TypeController extends AbstractController
{
    //use RenderTrait;

    protected $typeManager;

    public function __construct(
        TypeManager $typeManager
    ) {
        $this->typeManager = $typeManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        print_r($this->getUser());

        /*if (null !== $id) {
            $issue = $this->issueManager->findIssueById($id, $action);
            $parameters->set('issue', $issue);
            $parameters->set('jwtNotes', Notes::getToken($this->getUser()));
        } else {
            $issue = null;
        }*/

        switch ($action) {
            case 'index':
                return $this->indexAction($request);
            case 'create':
                return $this->createAction($request);
            case 'read':
                return $this->readAction($request, $id);
            case 'update':
                return $this->updateAction($request, $id);
            case 'delete':
                return $this->deleteAction($request, $id);
        }

        throw new NotFoundHttpException();
    }

    public function indexAction(Request $request)
    {

        $parameters = [];
        $parameters['objects'] = $this->typeManager->getIndex();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $this->typeManager->getIndex(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        $parameters['objects'] = $pagination;

        return $this->render('BackendBundle:Type:index.html.twig', $parameters);
    }

    public function createAction(Request $request)
    {
        $type = new Type();
        $type->setIcon('leaf');
        $type->setIsSitemap(true);

        $form = $this->createForm('Project29k\BackendBundle\Form\Type\TypeType', new Type(), ['categories' => $this->typeManager->getCategories(), 'new_option' => 'OO']);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('backend_type', []);
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();

        return $this->render('BackendBundle:Type:create.html.twig', $parameters);
    }

    public function readAction(Request $request, $id)
    {
        $type = $this->typeManager->getById($id);

        $parameters = [];
        $parameters['type'] = $type;

        return $this->render('BackendBundle:Type:read.html.twig', $parameters);
    }

    public function updateAction(Request $request, $id)
    {
        $type = $this->typeManager->getById($id);

        $form = $this->createForm('Project29k\BackendBundle\Form\Type\TypeType', $type, ['categories' => $this->typeManager->getCategories(), 'new_option' => 'OO']);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('backend_type', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();
        $parameters['type'] = $type;

        return $this->render('BackendBundle:Type:update.html.twig', $parameters);
    }

    public function deleteAction(Request $request, $id)
    {
        $type = $this->typeManager->getById($id);

        $form = $this->createForm('Project29k\BackendBundle\Form\Type\DeleteType', null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->remove($type);
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('backend_type', []);
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();
        $parameters['type'] = $type;

        return $this->render('BackendBundle:Type:delete.html.twig', $parameters);
    }
}
