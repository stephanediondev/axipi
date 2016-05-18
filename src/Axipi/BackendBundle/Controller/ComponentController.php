<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\ComponentManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ComponentType;
use Axipi\CoreBundle\Entity\Component;

class ComponentController extends AbstractController
{
    protected $componentManager;

    public function __construct(
        ComponentManager $componentManager
    ) {
        $this->componentManager = $componentManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        $parameters = new ParameterBag();

        if(null !== $id) {
            $component = $this->componentManager->getById($id);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('backend_component', []);
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
        return $this->redirectToRoute('backend_component', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['pageParameterName' => 'types']);
        $pagination = $paginator->paginate(
            $this->componentManager->getIndex(),
            $request->query->getInt('page', 1),
            20
        );

        $parameters->set('objects', $pagination);

        return $this->render('AxipiBackendBundle:Component:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $form = $this->createForm(ComponentType::class, new Component(), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('backend_component', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('AxipiBackendBundle:Component:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(ComponentType::class, $parameters->get('component'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('backend_component', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->remove($parameters->get('component'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('backend_component', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:delete.html.twig', $parameters->all());
    }
}
