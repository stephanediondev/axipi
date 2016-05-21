<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\WidgetManager;
use Axipi\BackendBundle\Manager\WidgetPageManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\WidgetPageType;
use Axipi\CoreBundle\Entity\Widget;
use Axipi\CoreBundle\Entity\WidgetPage;

class WidgetPageController extends AbstractController
{
    protected $widgetManager;

    protected $widgetPageManager;

    public function __construct(
        WidgetManager $widgetManager,
        WidgetPageManager $widgetPageManager
    ) {
        $this->widgetManager = $widgetManager;
        $this->widgetPageManager = $widgetPageManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        $parameters = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $widget = $this->widgetManager->getById($id);
            if($widget) {
                $parameters->set('widget', $widget);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widget', []);
            }
        } else if(null !== $id) {
            $widget_page = $this->widgetPageManager->getById($id);
            if($widget_page) {
                $parameters->set('widget_page', $widget_page);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widget', []);
            }
        }

        switch ($action) {
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
        return $this->redirectToRoute('axipi_backend_widget', []);
    }

    public function createAction(Request $request, ParameterBag $parameters, $id)
    {
        $widget_page = new WidgetPage();
        $widget_page->setWidget($parameters->get('widget'));
        $widget_page->setIsActive(true);

        $form = $this->createForm(WidgetPageType::class, $widget_page, ['widget_page' => $widget_page, 'pages' => $this->widgetPageManager->getPages()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetPageManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_widget_page', ['action' => 'read', 'id' => $widget_page->getId()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:WidgetPage:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('AxipiBackendBundle:WidgetPage:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(WidgetPageType::class, $parameters->get('widget_page'), ['widget_page' => $parameters->get('widget_page'), 'pages' => $this->widgetPageManager->getPages()]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetPageManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_widget_page', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:WidgetPage:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->widgetPageManager->remove($parameters->get('widget_page'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_widget', ['action' => 'read', 'id' => $parameters->get('widget_page')->getWidget()->getId()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:WidgetPage:delete.html.twig', $parameters->all());
    }
}
