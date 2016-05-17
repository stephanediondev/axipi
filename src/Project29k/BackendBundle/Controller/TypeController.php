<?php

namespace Project29k\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

use Project29k\BackendBundle\Manager\TypeManager;
use Project29k\CoreBundle\DependencyInjection\RenderTrait;
use Project29k\CoreBundle\Entity\Type;

class TypeController
{
    use RenderTrait;

    protected $typeManager;

    public function __construct(
        TypeManager $typeManager
    ) {
        $this->typeManager = $typeManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        /*if (null !== $id) {
            $issue = $this->issueManager->findIssueById($id, $action);
            $parameters->set('issue', $issue);
            $parameters->set('jwtNotes', Notes::getToken($this->getUser()));
        } else {
            $issue = null;
        }*/

        switch ($action) {
            case 'index':
                return $this->indexAction($request);
            case 'create':
                return $this->createAction($request);
            case 'read':
                return $this->readAction($request, $id);
            case 'update':
                return $this->updateAction($request, $id);
            case 'delete':
                return $this->deleteAction($request, $id);
        }

        throw new NotFoundHttpException();
    }

    public function indexAction(Request $request)
    {

        $parameters = [];
        $parameters['objects'] = $this->typeManager->getIndex();

        return $this->renderExtended('BackendBundle:Type:index.html.twig', $parameters);
    }

    public function createAction(Request $request)
    {
        $type = new Type();
        $type->setIcon('leaf');
        $type->setIsSitemap(true);

        $form = $this->formFactory->create('Project29k\BackendBundle\Form\Type\TypeType', new Type(), ['categories' => $this->typeManager->getCategories(), 'new_option' => 'OO']);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->persist($form->getData());
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();

        return $this->renderExtended('BackendBundle:Type:create.html.twig', $parameters);
    }

    public function readAction(Request $request, $id)
    {
        $type = $this->typeManager->getById($id);

        $parameters = [];
        $parameters['type'] = $type;

        return $this->renderExtended('BackendBundle:Type:read.html.twig', $parameters);
    }

    public function updateAction(Request $request, $id)
    {
        $type = $this->typeManager->getById($id);

        $form = $this->formFactory->create('Project29k\BackendBundle\Form\Type\TypeType', $type, ['categories' => $this->typeManager->getCategories(), 'new_option' => 'OO']);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->persist($form->getData());
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();
        $parameters['type'] = $type;

        return $this->renderExtended('BackendBundle:Type:update.html.twig', $parameters);
    }

    public function deleteAction(Request $request, $id)
    {
        $type = $this->typeManager->getById($id);

        $form = $this->formFactory->create('Project29k\BackendBundle\Form\Type\DeleteType', null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->typeManager->remove($type);
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();
        $parameters['type'] = $type;

        return $this->renderExtended('BackendBundle:Type:delete.html.twig', $parameters);
    }
}
