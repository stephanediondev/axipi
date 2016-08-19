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
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $parameterBag->set('category', $id);
        } else if(null !== $id) {
            $component = $this->componentManager->getOne(['id' => $id]);
            if($component) {
                $parameterBag->set('component', $component);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameterBag);
            case 'create':
                return $this->createAction($request, $parameterBag);
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
        $parameterBag->set('pages', $this->componentManager->getList(['category' => 'page']));
        $parameterBag->set('widgets', $this->componentManager->getList(['category' => 'widget']));

        return $this->render('AxipiBackendBundle:Component:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag)
    {
        $component = new Component();
        $component->setCategory($parameterBag->get('category'));
        $component->setIsActive(true);

        $form = $this->createForm(ComponentType::class, $component, [
            'component' => $component,
            'components' => [
                'Page' => $this->componentManager->getList(['category' => 'page']),
                'Widget' => $this->componentManager->getList(['category' => 'widget'])
            ],
            'zones' => $this->zoneManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_component', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        return $this->render('AxipiBackendBundle:Component:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(ComponentType::class, $parameterBag->get('component'), [
            'component' => $parameterBag->get('component'),
            'components' => [
                'Page' => $this->componentManager->getList(['category' => 'page']),
                'Widget' => $this->componentManager->getList(['category' => 'widget'])
            ],
            'zones' => $this->zoneManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_component', ['action' => 'read', 'id' => $parameterBag->get('component')->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->componentManager->remove($parameterBag->get('component'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_component', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Component:delete.html.twig', $parameterBag->all());
    }
}
