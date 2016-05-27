<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\PageManager;
use Axipi\BackendBundle\Manager\ComponentManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\PageType;
use Axipi\CoreBundle\Entity\Page;

class PageController extends AbstractController
{
    protected $pageManager;

    protected $componentManager;

    public function __construct(
        PageManager $pageManager,
        ComponentManager $componentManager
    ) {
        $this->pageManager = $pageManager;
        $this->componentManager = $componentManager;
    }

    public function dispatchAction(Request $request, $language, $action, $id)
    {
        if($language == 'xx') {
            return $this->redirectToRoute('axipi_backend_page', ['language' => 'en', 'action' => 'index']);
        }

        $parameters = new ParameterBag();
        $parameters->set('languages', $this->pageManager->getLanguages());
        $parameters->set('language', $this->pageManager->getLanguageByCode($language));

        if($action == 'create' && null !== $id) {
            $component = $this->componentManager->getById($id);
            if($component) {
                $parameters->set('component', $component);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_page', ['language' => $language]);
            }
        } else if(null !== $id) {
            $page = $this->pageManager->getById($id);
            if($page) {
                $parameters->set('page', $page);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_page', ['language' => $language]);
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
        return $this->redirectToRoute('axipi_backend_page', ['language' => $language]);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $language)
    {
        $parameters->set('objects', $this->pageManager->getRows($language, null)->getResult());
        $parameters->set('components', $this->pageManager->getComponents());

        return $this->render('AxipiBackendBundle:Page:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters)
    {
        $page = new Page();
        $page->setLanguage($parameters->get('language'));
        $page->setComponent($parameters->get('component'));
        $page->setIsActive(true);

        $form = $this->createForm(PageType::class, $page, ['page' => $page, 'languages' => $parameters->get('languages'), 'components' => $this->pageManager->getComponents(), 'pages' => $this->pageManager->getPages($page)]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->pageManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_page', ['language' => $parameters->get('language')->getCode()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('AxipiBackendBundle:Page:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(PageType::class, $parameters->get('page'), ['page' => $parameters->get('page'), 'languages' => $parameters->get('languages'), 'components' => $this->pageManager->getComponents(), 'pages' => $this->pageManager->getPages($parameters->get('page'))]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->pageManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_page', ['language' => $parameters->get('language')->getCode(), 'action' => 'read', 'id' => $id]);
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
                return $this->redirectToRoute('axipi_backend_page', ['language' => $parameters->get('language')->getCode()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Page:delete.html.twig', $parameters->all());
    }
}
