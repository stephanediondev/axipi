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
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        if($language == 'xx') {
            return $this->redirectToRoute('axipi_backend_pages', ['mode' => $mode, 'language' => 'en', 'action' => 'index']);
        }

        $parameters = new ParameterBag();
        $parameters->set('mode', $mode);
        $parameters->set('languages', $this->languageManager->getList());
        $parameters->set('language', $this->languageManager->getOne(['code' => $language]));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getOne(['id' => $id]);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $mode, 'language' => $language]);
            }
        } else if(null !== $id) {
            $page = $this->itemManager->getOne(['id' => $id]);
            if($page) {
                $parameters->set('page', $page);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $mode, 'language' => $language]);
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
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_pages', ['mode' => $mode, 'language' => $language]);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $language)
    {
        $parameters->set('objects', $this->itemManager->getList(['category' => 'page', 'language_code' => $language, 'parent_null' => true]));
        $parameters->set('components', $this->componentManager->getList(['category' => 'page', 'active' => true]));

        return $this->render('AxipiBackendBundle:Page:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $page = new Item();
        if($request->query->get('parent')) {
            $page_parent = $this->itemManager->getOne(['id' => $request->query->get('parent')]);
            if($page_parent) {
                $parameters->set('page_parent', $page_parent);
                $page->setParent($page_parent);
            }
        }
        $page->setLanguage($parameters->get('language'));
        $page->setComponent($parameters->get('component'));
        $page->setIsActive(true);

        $form = $this->createForm(ItemType::class, $page, [
            'item' => $page,
            'items' => $this->itemManager->getList(['component_parent' => $page]),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $id = $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        $parameters->set('components', $this->componentManager->getList(['category' => 'page', 'active' => true]));

        $languages = $this->languageManager->getList(['active' => true]);
        $this->container->get('axipi_core_manager_default')->setLanguages($languages);
        $parameters->set('languages', $languages);

        return $this->render('AxipiBackendBundle:Page:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(ItemType::class, $parameters->get('page'), [
            'item' => $parameters->get('page'),
            'items' => $this->itemManager->getList(['component_parent' => $parameters->get('page')]),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->itemManager->remove($parameters->get('page'));
                $this->addFlash('success', 'deleted');
                if($parameters->get('page')->getParent()) {
                    return $this->redirectToRoute('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $parameters->get('page')->getParent()->getId()]);
                } else {
                    return $this->redirectToRoute('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode()]);
                }
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:delete.html.twig', $parameters->all());
    }

    public function uploadAction(Request $request, ParameterBag $parameters)
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

            $page->setLanguage($parameters->get('language'));
            $page->setComponent($component);
            $page->setIsActive(true);

            $id = $this->itemManager->persist($page);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'icon' => $component->geticon(),
                'href' => $this->generateUrl('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]),
            ];
        }

        return new JsonResponse($data);
    }
}
