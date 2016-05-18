<?php

namespace Project29k\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Project29k\CoreBundle\Controller\AbstractController;

use Project29k\BackendBundle\Manager\TypeManager;
use Project29k\BackendBundle\Form\Type\DeleteType;
use Project29k\BackendBundle\Form\Type\TypeType;
use Project29k\CoreBundle\Entity\Type;

class TypeController extends AbstractController
{
    protected $typeManager;

    public function __construct(
        TypeManager $typeManager
    ) {
        $this->typeManager = $typeManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        $parameters = new ParameterBag();

        if(null !== $id) {
            $type = $this->typeManager->getById($id);
            if($type) {
                $parameters->set('type', $type);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('backend_type', []);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters);
            case 'create':
                return $this->createAction($request, $parameters);
            case 'read':
                return $this->readAction($request, $parameters, $id);
            case 'update':
                return $this->updateAction($request, $parameters, $id);
            case 'delete':
                return $this->deleteAction($request, $parameters, $id);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('backend_type', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['pageParameterName' => 'types']);
        $pagination = $paginator->paginate(
            $this->typeManager->getIndex(),
            $request->query->getInt('page', 1),
            20
        );

        $parameters->set('objects', $pagination);

        return $this->render('BackendBundle:Type:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $form = $this->createForm(TypeType::class, new Type(), ['categories' => $this->typeManager->getCategories()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('backend_type', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('BackendBundle:Type:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('BackendBundle:Type:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(TypeType::class, $parameters->get('type'), ['categories' => $this->typeManager->getCategories()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('backend_type', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('BackendBundle:Type:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->remove($parameters->get('type'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('backend_type', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('BackendBundle:Type:delete.html.twig', $parameters->all());
    }
}
