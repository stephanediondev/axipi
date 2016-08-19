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
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ItemType;
use Axipi\CoreBundle\Entity\Item;

class PageController extends AbstractController
{
    protected $itemManager;

    protected $languageManager;

    protected $componentManager;

    public function __construct(
        ItemManager $itemManager,
        LanguageManager $languageManager,
        ComponentManager $componentManager
    ) {
        $this->itemManager = $itemManager;
        $this->languageManager = $languageManager;
        $this->componentManager = $componentManager;
    }

    public function dispatchAction(Request $request, $mode, $language, $action, $id)
    {
        if(!$this->isGranted('ROLE_PAGES')) {
            return $this->displayError(403);
        }

        if($language == 'xx') {
            return $this->redirectToRoute('axipi_backend_page', ['mode' => $mode, 'language' => 'en', 'action' => 'index']);
        }

        $parameterBag = new ParameterBag();
        $parameterBag->set('mode', $mode);
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
            $page = $this->itemManager->getOne(['id' => $id]);
            if($page) {
                $parameterBag->set('page', $page);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameterBag, $language);
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
            case 'sort':
                return $this->sortAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag, $language)
    {
        $parameterBag->set('parent_null', $this->itemManager->getList(['category' => 'page', 'language_code' => $language, 'parent_null' => true]));
        $parameterBag->set('components', $this->componentManager->getList(['category' => 'page', 'active' => true]));

        return $this->render('AxipiBackendBundle:Page:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag)
    {
        $page = new Item();
        if($request->query->get('parent')) {
            $page_parent = $this->itemManager->getOne(['id' => $request->query->get('parent')]);
            if($page_parent) {
                $parameterBag->set('page_parent', $page_parent);
                $page->setParent($page_parent);
            }
        }
        $page->setLanguage($parameterBag->get('language'));
        $page->setComponent($parameterBag->get('component'));
        $page->setIsHome($parameterBag->get('component')->getIshome());
        $page->setIsActive(true);

        $form = $this->createForm(ItemType::class, $page, [
            'item' => $page,
            'items' => $this->itemManager->getList(['component_parent' => $page, 'category' => 'page']),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $id = $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_page', ['mode' => $parameterBag->get('mode'), 'language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('components', $this->componentManager->getList(['category' => 'page', 'active' => true]));

        $languages = $this->languageManager->getList(['active' => true]);
        $this->container->get('axipi_core_manager_default')->setLanguages($languages);
        $parameterBag->set('languages', $languages);

        return $this->render('AxipiBackendBundle:Page:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(ItemType::class, $parameterBag->get('page'), [
            'item' => $parameterBag->get('page'),
            'items' => $this->itemManager->getList(['component_parent' => $parameterBag->get('page'), 'category' => 'page']),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_page', ['mode' => $parameterBag->get('mode'), 'language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $parameterBag->get('page')->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->remove($parameterBag->get('page'));
                $this->addFlash('success', 'deleted');
                if($parameterBag->get('page')->getParent()) {
                    return $this->redirectToRoute('axipi_backend_page', ['mode' => $parameterBag->get('mode'), 'language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $parameterBag->get('page')->getParent()->getId()]);
                } else {
                    return $this->redirectToRoute('axipi_backend_page', ['mode' => $parameterBag->get('mode'), 'language' => $parameterBag->get('language')->getCode()]);
                }
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:delete.html.twig', $parameterBag->all());
    }

    public function uploadAction(Request $request, ParameterBag $parameterBag)
    {
        $data = [];

        $component = $this->componentManager->getOne(['id' => $request->request->get('component')]);

        foreach($request->files->get('files', []) as $key => $uploadedFile) {
            $title = uniqid('', true);

            $page = new Item();
            if($request->request->get('parent')) {
                $page_parent = $this->itemManager->getOne(['id' => $request->request->get('parent')]);
                if($page_parent) {
                    $page->setParent($page_parent);
                    $page->setSlug($page_parent->getSlug().'/'.$title);
                }
            }

            $page->setTitle($title);
            $page->setAttributesChange(['image' => $uploadedFile]);

            $page->setLanguage($parameterBag->get('language'));
            $page->setComponent($component);
            $page->setIsActive(true);

            $id = $this->itemManager->persist($page);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'icon' => $component->geticon(),
                'href' => $this->generateUrl('axipi_backend_page', ['mode' => $parameterBag->get('mode'), 'language' => $parameterBag->get('language')->getCode(), 'action' => 'read', 'id' => $id]),
            ];
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
}
