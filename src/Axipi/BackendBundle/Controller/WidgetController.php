<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\ItemManager;
use Axipi\CoreBundle\Manager\LanguageManager;
use Axipi\CoreBundle\Manager\ComponentManager;
use Axipi\CoreBundle\Manager\RelationManager;
use Axipi\CoreBundle\Manager\ZoneManager;
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
        $parameters->set('language', $this->languageManager->getOne(['code' => $language]));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getOne(['id' => $id]);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $language]);
            }
        } else if(null !== $id) {
            $widget = $this->itemManager->getOne(['id' => $id]);
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
            case 'upload':
                return $this->uploadAction($request, $parameters);
            case 'wysiwyg':
                return $this->wysiwygAction($request, $parameters);
            case 'sort':
                return $this->sortAction($request, $parameters);
            case 'move':
                return $this->moveAction($request, $parameters, $id);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_components', ['language' => $language]);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $language)
    {
        $parameters->set('components', $this->componentManager->getList(['category' => 'widget', 'active' => true]));
        $parameters->set('zones', $this->zoneManager->getList());
        $parameters->set('no_zone', $this->itemManager->getList(['category' => 'widget', 'zone_null' => true, 'parent_null' => true]));

        return $this->render('AxipiBackendBundle:Widget:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $widget = new Item();
        if($request->query->get('parent')) {
            $widget_parent = $this->itemManager->getOne(['id' => $request->query->get('parent')]);
            if($widget_parent) {
                $parameters->set('widget_parent', $widget_parent);
                $widget->setParent($widget_parent);
            }
        }
        $widget->setLanguage($parameters->get('language'));
        $widget->setComponent($parameters->get('component'));
        $widget->setZone($parameters->get('component')->getZone());
        $widget->setIsActive(true);

        $form = $this->createForm(ItemType::class, $widget, [
            'item' => $widget,
            'zones' => $this->zoneManager->getList(),
            'items' => [
                'Page' => $this->itemManager->getList(['component_parent' => $widget, 'category' => 'page']),
                'Widget' => $this->itemManager->getList(['component_parent' => $widget, 'category' => 'widget']),
            ],
            'languages' => $this->languageManager->getList(),
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
        $parameters->set('relations', $this->relationManager->getList(['widget' => $id, 'parent_null' => true]));
        $parameters->set('components', $this->componentManager->getList(['category' => 'widget', 'active' => true]));

        return $this->render('AxipiBackendBundle:Widget:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(ItemType::class, $parameters->get('widget'), [
            'item' => $parameters->get('widget'),
            'zones' => $this->zoneManager->getList(),
            'items' => [
                'Page' => $this->itemManager->getList(['component_parent' => $parameters->get('widget'), 'category' => 'page']),
                'Widget' => $this->itemManager->getList(['component_parent' => $parameters->get('widget'), 'category' => 'widget']),
            ],
            'languages' => $this->languageManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                if($parameters->get('language')) {
                    return $this->redirectToRoute('axipi_backend_widgets', ['language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
                } else {
                    return $this->redirectToRoute('axipi_backend_widgets', ['language' => 'null', 'action' => 'read', 'id' => $id]);
                }
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
                if($parameters->get('language')) {
                    return $this->redirectToRoute('axipi_backend_widgets', ['language' => $parameters->get('language')->getCode()]);
                } else {
                    return $this->redirectToRoute('axipi_backend_widgets', ['language' => 'null']);
                }
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:delete.html.twig', $parameters->all());
    }

    public function uploadAction(Request $request, ParameterBag $parameters)
    {
        $data = [];

        $component = $this->componentManager->getOne(['id' => $request->request->get('component')]);

        foreach($request->files->get('files', []) as $key => $uploadedFile) {
            $title = uniqid('', true);

            $widget = new Item();
            if($request->request->get('parent')) {
                $widget_parent = $this->itemManager->getOne(['id' => $request->request->get('parent')]);
                if($widget_parent) {
                    $widget->setParent($widget_parent);
                }
            }

            $widget->setTitle($title);
            $widget->setAttributesChange(['image' => $uploadedFile]);

            $widget->setLanguage($parameters->get('language'));
            $widget->setComponent($component);
            $widget->setIsActive(true);

            $id = $this->itemManager->persist($widget);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'icon' => $component->geticon(),
                'href' => $this->generateUrl('axipi_backend_widgets', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]),
            ];
        }

        return new JsonResponse($data);
    }

    public function wysiwygAction(Request $request, ParameterBag $parameters)
    {
        $data = [];
        $data['widgets'] = [];

        $results = $this->itemManager->getList(['category' => 'widget', 'zone_null' => true, 'parent_null' => true]);
        foreach($results as $result) {
            $data['widgets'][] = ['value' => '[widget:'.$result->getId().']', 'text' => $result->getTitle()];
        }

        return new JsonResponse($data);
    }

    public function sortAction(Request $request, ParameterBag $parameters)
    {
        $data = json_decode($request->request->get('result'));
        foreach($data as $id => $ordering) {
            $item = $this->itemManager->getOne(['id' => intval($id)]);
            if($item) {
                $item->setOrdering(intval($ordering));
                $this->itemManager->persist($item);
            }
        }

        return new JsonResponse($data);
    }

    public function moveAction(Request $request, ParameterBag $parameters, $id)
    {
        $data = [];

        $zone = $this->zoneManager->getOne(['id' => $request->request->get('zone')]);
        if($zone) {
            $parameters->get('widget')->setZone($zone);
            $this->itemManager->persist($parameters->get('widget'));
        }

        return new JsonResponse($data);
    }
}
