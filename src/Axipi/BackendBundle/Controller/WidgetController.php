<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\ItemManager;
use Axipi\BackendBundle\Manager\LanguageManager;
use Axipi\BackendBundle\Manager\ComponentManager;
use Axipi\BackendBundle\Manager\RelationManager;
use Axipi\BackendBundle\Manager\ZoneManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ItemType;
use Axipi\CoreBundle\Entity\Item;

class WidgetController extends AbstractController
{
    protected $itemManager;

    protected $languageManager;

    protected $componentManager;

    protected $relationManager;

    protected $zoneManager;

    public function __construct(
        ItemManager $itemManager,
        LanguageManager $languageManager,
        ComponentManager $componentManager,
        RelationManager $relationManager,
        ZoneManager $zoneManager
    ) {
        $this->itemManager = $itemManager;
        $this->languageManager = $languageManager;
        $this->componentManager = $componentManager;
        $this->relationManager = $relationManager;
        $this->zoneManager = $zoneManager;
    }

    public function dispatchAction(Request $request, $language, $action, $id)
    {
        if(!$this->isGranted('ROLE_WIDGETS')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        if($language == 'xx') {
            return $this->redirectToRoute('axipi_backend_widgets', ['language' => 'en', 'action' => 'index']);
        }

        $parameters = new ParameterBag();
        $parameters->set('languages', $this->languageManager->getList());
        $parameters->set('language', $this->languageManager->getByCode($language));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getById($id);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $language]);
            }
        } else if(null !== $id) {
            $widget = $this->itemManager->getById($id);
            if($widget) {
                $parameters->set('widget', $widget);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $language]);
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
        return $this->redirectToRoute('axipi_backend_components', ['language' => $language]);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $language)
    {
        $parameters->set('components', $this->componentManager->getList(['category' => 'widget', 'active' => true]));
        $parameters->set('zones', $this->zoneManager->getList());

        return $this->render('AxipiBackendBundle:Widget:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $widget = new Item();
        $widget->setLanguage($parameters->get('language'));
        $widget->setComponent($parameters->get('component'));
        $widget->setZone($parameters->get('component')->getZone());
        $widget->setIsActive(true);

        $form = $this->createForm(ItemType::class, $widget, [
            'item' => $widget,
            'zones' => $this->zoneManager->getList(),
            'items' => $this->itemManager->getList(['component_parent' => $widget]),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $id = $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        $parameters->set('objects', $this->relationManager->getList(['widget' => $id]));

        return $this->render('AxipiBackendBundle:Widget:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(ItemType::class, $parameters->get('widget'), [
            'item' => $parameters->get('widget'),
            'zones' => $this->zoneManager->getList(),
            'items' => $this->itemManager->getList(['component_parent' => $parameters->get('widget')]),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
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
                $this->itemManager->remove($parameters->get('widget'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $parameters->get('language')->getCode()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:delete.html.twig', $parameters->all());
    }
}
