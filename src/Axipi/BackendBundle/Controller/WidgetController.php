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

    public function dispatchAction(Request $request, $language, $action, $id)
    {
        if($language == 'xx') {
            return $this->redirectToRoute('axipi_backend_widget', ['language' => 'en', 'action' => 'index']);
        }

        $parameters = new ParameterBag();
        $parameters->set('languages', $this->widgetManager->getLanguages());
        $parameters->set('language', $this->widgetManager->getLanguageByCode($language));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getById($id);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $language]);
            }
        } else if(null !== $id) {
            $widget = $this->widgetManager->getById($id);
            if($widget) {
                $parameters->set('widget', $widget);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $language]);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters, $language);
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
        return $this->redirectToRoute('axipi_backend_component', ['language' => $language]);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $language)
    {
        $parameters->set('components', $this->widgetManager->getComponents());
        $parameters->set('zones', $this->widgetManager->getZones());

        return $this->render('AxipiBackendBundle:Widget:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $widget = new Widget();
        $widget->setComponent($parameters->get('component'));
        $widget->setZone($parameters->get('component')->getZone());
        $widget->setIsActive(true);

        $form = $this->createForm(WidgetType::class, $widget, ['widget' => $widget, 'languages' => $parameters->get('languages'), 'components' => $this->widgetManager->getComponents(), 'zones' => $this->widgetManager->getZones()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $parameters->get('language')->getCode()]);
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
        $form = $this->createForm(WidgetType::class, $parameters->get('widget'), ['widget' => $parameters->get('widget'), 'languages' => $parameters->get('languages'), 'components' => $this->widgetManager->getComponents(), 'zones' => $this->widgetManager->getZones()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
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
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $parameters->get('language')->getCode()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:delete.html.twig', $parameters->all());
    }
}
