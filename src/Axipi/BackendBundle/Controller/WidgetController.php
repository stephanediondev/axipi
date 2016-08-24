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
            return $this->displayError(403);
        }

        if($language == 'xx') {
            return $this->redirectToRoute('axipi_backend_widget', ['language' => 'en', 'action' => 'index']);
        }

        $parameterBag = new ParameterBag();
        $parameterBag->set('languages', $this->languageManager->getList());
        $parameterBag->set('language', $this->languageManager->getOne(['code' => $language]));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getOne(['id' => $id]);
            if($component) {
                $parameterBag->set('component', $component);
            } else {
                return $this->displayError(404);
            }
        } else if(null !== $id) {
            $widget = $this->itemManager->getOne(['id' => $id]);
            if($widget) {
                $parameterBag->set('widget', $widget);
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
            case 'upload':
                return $this->uploadAction($request, $parameterBag);
            case 'wysiwyg':
                return $this->wysiwygAction($request, $parameterBag);
            case 'sort':
                return $this->sortAction($request, $parameterBag);
            case 'move':
                return $this->moveAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('components', $this->componentManager->getList(['category' => 'widget', 'active' => true]));
        $parameterBag->set('zones', $this->zoneManager->getList());
        $parameterBag->set('no_zone', $this->itemManager->getList(['category' => 'widget', 'zone_null' => true, 'parent_null' => true]));

        return $this->render('AxipiBackendBundle:Widget:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag)
    {
        $widget = new Item();
        if($request->query->get('parent')) {
            $widget_parent = $this->itemManager->getOne(['id' => $request->query->get('parent')]);
            if($widget_parent) {
                $parameterBag->set('widget_parent', $widget_parent);
                $widget->setParent($widget_parent);
            }
        }
        $widget->setLanguage($parameterBag->get('language'));
        $widget->setComponent($parameterBag->get('component'));
        $widget->setZone($parameterBag->get('component')->getZone());
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
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('relations', $this->relationManager->getList(['widget' => $parameterBag->get('widget')->getid(), 'parent_null' => true]));
        $parameterBag->set('components', $this->componentManager->getList(['category' => 'widget', 'active' => true]));

        return $this->render('AxipiBackendBundle:Widget:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(ItemType::class, $parameterBag->get('widget'), [
            'item' => $parameterBag->get('widget'),
            'zones' => $this->zoneManager->getList(),
            'items' => [
                'Page' => $this->itemManager->getList(['component_parent' => $parameterBag->get('widget'), 'category' => 'page']),
                'Widget' => $this->itemManager->getList(['component_parent' => $parameterBag->get('widget'), 'category' => 'widget']),
            ],
            'languages' => $this->languageManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                if($parameterBag->get('language')) {
                    return $this->redirectToRoute('axipi_backend_widget', ['language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $parameterBag->get('widget')->getId()]);
                } else {
                    return $this->redirectToRoute('axipi_backend_widget', ['language' => 'null', 'action' => 'read', 'id' => $parameterBag->get('widget')->getid()]);
                }
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->remove($parameterBag->get('widget'));
                $this->addFlash('success', 'deleted');
                if($parameterBag->get('language')) {
                    return $this->redirectToRoute('axipi_backend_widget', ['language' => $parameterBag->get('language')->getCode()]);
                } else {
                    return $this->redirectToRoute('axipi_backend_widget', ['language' => 'null']);
                }
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Widget:delete.html.twig', $parameterBag->all());
    }

    public function uploadAction(Request $request, ParameterBag $parameterBag)
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

            $widget->setLanguage($parameterBag->get('language'));
            $widget->setComponent($component);
            $widget->setIsActive(true);

            $id = $this->itemManager->persist($widget);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'icon' => $component->geticon(),
                'href' => $this->generateUrl('axipi_backend_widget', ['mode' => $parameterBag->get('mode'), 'language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $id]),
            ];
        }

        return new JsonResponse($data);
    }

    public function wysiwygAction(Request $request, ParameterBag $parameterBag)
    {
        $data = [];
        $data['widgets'] = [];

        $results = $this->itemManager->getList(['category' => 'widget', 'zone_null' => true, 'parent_null' => true]);
        foreach($results as $result) {
            $data['widgets'][] = ['value' => '[widget:'.$result->getId().']', 'text' => $result->getTitle()];
        }

        return new JsonResponse($data);
    }

    public function sortAction(Request $request, ParameterBag $parameterBag)
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

    public function moveAction(Request $request, ParameterBag $parameterBag)
    {
        $data = [];

        $zone = $this->zoneManager->getOne(['id' => $request->request->get('zone')]);
        if($zone) {
            $parameterBag->get('widget')->setZone($zone);
            $this->itemManager->persist($parameterBag->get('widget'));
        }

        return new JsonResponse($data);
    }
}
