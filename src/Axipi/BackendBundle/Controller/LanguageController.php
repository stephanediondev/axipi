<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\LanguageManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\LanguageType;
use Axipi\CoreBundle\Entity\Language;

class LanguageController extends AbstractController
{
    protected $languageManager;

    public function __construct(
        LanguageManager $languageManager
    ) {
        $this->languageManager = $languageManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        if(!$this->isGranted('ROLE_LANGUAGES')) {
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        if(null !== $id) {
            $language = $this->languageManager->getOne(['id' => $id]);
            if($language) {
                $parameterBag->set('language', $language);
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
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('objects', $this->languageManager->getList());

        return $this->render('AxipiBackendBundle:Language:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag)
    {
        $language = new Language();
        $language->setIsActive(true);

        $form = $this->createForm(LanguageType::class, $language, [
            'language' => $language,
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $id = $this->languageManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_language', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Language:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        return $this->render('AxipiBackendBundle:Language:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(LanguageType::class, $parameterBag->get('language'), [
            'language' => $parameterBag->get('language'),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->languageManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_language', ['action' => 'read', 'id' => $parameterBag->get('language')->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Language:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->languageManager->remove($parameterBag->get('language'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_language', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Language:delete.html.twig', $parameterBag->all());
    }
}
