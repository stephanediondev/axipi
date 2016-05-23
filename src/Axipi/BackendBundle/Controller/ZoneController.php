<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\ZoneManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ZoneType;
use Axipi\CoreBundle\Entity\Zone;

class ZoneController extends AbstractController
{
    protected $zoneManager;

    public function __construct(
        ZoneManager $zoneManager
    ) {
        $this->zoneManager = $zoneManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        $parameters = new ParameterBag();

        if(null !== $id) {
            $zone = $this->zoneManager->getById($id);
            if($zone) {
                $parameters->set('zone', $zone);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_zone', []);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters);
            case 'create':
                return $this->createAction($request, $parameters, $id);
            case 'read':
                return $this->readAction($request, $parameters, $id);
            case 'update':
                return $this->updateAction($request, $parameters, $id);
            case 'delete':
                return $this->deleteAction($request, $parameters, $id);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_zone', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['pageParameterName' => 'zones']);
        $pagination = $paginator->paginate(
            $this->zoneManager->getRows(),
            $request->query->getInt('zones', 1),
            20
        );

        $parameters->set('objects', $pagination);

        return $this->render('AxipiBackendBundle:Zone:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters, $id)
    {
        $zone = new Zone();
        $zone->setIsActive(true);

        $form = $this->createForm(ZoneType::class, $zone, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->zoneManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_zone', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Zone:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('AxipiBackendBundle:Zone:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(ZoneType::class, $parameters->get('zone'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->zoneManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_zone', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Zone:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->zoneManager->remove($parameters->get('zone'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_zone', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Zone:delete.html.twig', $parameters->all());
    }
}