<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\WidgetManager;
use Axipi\BackendBundle\Manager\ComponentManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\WidgetType;
use Axipi\CoreBundle\Entity\Widget;

class WidgetController extends AbstractController
{
    protected $widgetManager;

    protected $componentManager;

    public function __construct(
        WidgetManager $widgetManager,
        ComponentManager $componentManager
    ) {
        $this->widgetManager = $widgetManager;
        $this->componentManager = $componentManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        $parameters = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getById($id);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widget', []);
            }
        } else if(null !== $id) {
            $widget = $this->widgetManager->getById($id);
            if($widget) {
                $parameters->set('widget', $widget);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widget', []);
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
        return $this->redirectToRoute('axipi_backend_component', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $parameters->set('components', $this->widgetManager->getComponents());
        $parameters->set('zones', $this->widgetManager->getZones());

        return $this->render('AxipiBackendBundle:Widget:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters, $id)
    {
        $widget = new Widget();
        $widget->setComponent($parameters->get('component'));
        $widget->setZone($parameters->get('component')->getZone());
        $widget->setIsActive(true);

        $form = $this->createForm(WidgetType::class, $widget, ['widget' => $widget, 'programs' => $this->widgetManager->getPrograms(), 'components' => $this->widgetManager->getComponents(), 'zones' => $this->widgetManager->getZones()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_widget', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        $parameters->set('objects', $this->widgetManager->getPages($id));

        return $this->render('AxipiBackendBundle:Widget:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(WidgetType::class, $parameters->get('widget'), ['widget' => $parameters->get('widget'), 'programs' => $this->widgetManager->getPrograms(), 'components' => $this->widgetManager->getComponents(), 'zones' => $this->widgetManager->getZones()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_widget', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetManager->remove($parameters->get('widget'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_widget', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:delete.html.twig', $parameters->all());
    }
}
