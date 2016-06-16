<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\ComponentManager;
use Axipi\CoreBundle\Manager\ZoneManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ComponentType;
use Axipi\CoreBundle\Entity\Component;

class ComponentController extends AbstractController
{
    protected $componentManager;

    protected $zoneManager;

    public function __construct(
        ComponentManager $componentManager,
        ZoneManager $zoneManager
    ) {
        $this->componentManager = $componentManager;
        $this->zoneManager = $zoneManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        if(!$this->isGranted('ROLE_COMPONENTS')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $parameters->set('category', $id);
        } else if(null !== $id) {
            $component = $this->componentManager->getOne(['id' => $id]);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_components', []);
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
        return $this->redirectToRoute('axipi_backend_components', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $parameters->set('pages', $this->componentManager->getList(['category' => 'page']));
        $parameters->set('widgets', $this->componentManager->getList(['category' => 'widget']));

        return $this->render('AxipiBackendBundle:Component:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters, $id)
    {
        $component = new Component();
        $component->setCategory($parameters->get('category'));
        $component->setIsActive(true);

        $form = $this->createForm(ComponentType::class, $component, [
            'component' => $component,
            'components' => ['Page' => $this->componentManager->getList(['category' => 'page']), 'Widget' => $this->componentManager->getList(['category' => 'widget'])],
            'zones' => $this->zoneManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_components', []);
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
        $form = $this->createForm(ComponentType::class, $parameters->get('component'), [
            'component' => $parameters->get('component'),
            'components' => ['Page' => $this->componentManager->getList(['category' => 'page']), 'Widget' => $this->componentManager->getList(['category' => 'widget'])],
            'zones' => $this->zoneManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_components', ['action' => 'read', 'id' => $id]);
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
                return $this->redirectToRoute('axipi_backend_components', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:delete.html.twig', $parameters->all());
    }
}
