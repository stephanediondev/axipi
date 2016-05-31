<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\PageManager;
use Axipi\BackendBundle\Manager\ComponentManager;
use Axipi\SearchBundle\Manager\SearchManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\PageType;
use Axipi\CoreBundle\Entity\Item;

class PageController extends AbstractController
{
    protected $pageManager;

    protected $componentManager;

    protected $searchManager;

    public function __construct(
        PageManager $pageManager,
        ComponentManager $componentManager,
        SearchManager $searchManager
    ) {
        $this->pageManager = $pageManager;
        $this->componentManager = $componentManager;
        $this->searchManager = $searchManager;
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
        $parameters->set('languages', $this->pageManager->getLanguages());
        $parameters->set('language', $this->pageManager->getLanguageByCode($language));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getById($id);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $mode, 'language' => $language]);
            }
        } else if(null !== $id) {
            $page = $this->pageManager->getById($id);
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
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_pages', ['mode' => $mode, 'language' => $language]);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $language)
    {
        $parameters->set('objects', $this->pageManager->getRows($language, null)->getResult());
        $parameters->set('components', $this->pageManager->getComponents('page'));

        return $this->render('AxipiBackendBundle:Page:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $page = new Item();
        if($request->query->get('parent')) {
            $page_parent = $this->pageManager->getById($request->query->get('parent'));
            if($page_parent) {
                $parameters->set('page_parent', $page_parent);
                $page->setParent($page_parent);
            }
        }
        $page->setLanguage($parameters->get('language'));
        $page->setComponent($parameters->get('component'));
        $page->setIsActive(true);

        $form = $this->createForm(PageType::class, $page, ['page' => $page, 'pages' => $this->pageManager->getPages($page)]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $id = $this->pageManager->persist($form->getData());
                $this->searchManager->indexPage($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        $parameters->set('components', $this->pageManager->getComponents('page'));

        return $this->render('AxipiBackendBundle:Page:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(PageType::class, $parameters->get('page'), ['page' => $parameters->get('page'), 'pages' => $this->pageManager->getPages($parameters->get('page'))]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->pageManager->persist($form->getData());
                $this->searchManager->indexPage($form->getData());
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
                $this->pageManager->remove($parameters->get('page'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_pages', ['mode' => $parameters->get('mode'), 'language' => $parameters->get('language')->getCode()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:delete.html.twig', $parameters->all());
    }
}
