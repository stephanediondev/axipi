<?php

namespace Project29k\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

use Project29k\BackendBundle\Manager\TypeManager;
use Project29k\CoreBundle\DependencyInjection\RenderTrait;

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
        $issue = 8749;

        switch ($action) {
            case 'index':
                return $this->indexAction($request);
            case 'create':
                return $this->createAction($request);
            case 'read':
                return $this->readAction($request, $issue);
            case 'update':
                return $this->updateAction($request, $issue);
            case 'delete':
                return $this->deleteAction($request, $issue);
        }

        throw new NotFoundHttpException();
    }

    public function indexAction(Request $request)
    {
        return $this->renderExtended('BackendBundle::home.html.twig', [
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->renderExtended('BackendBundle::home.html.twig', [
        ]);
    }

    public function readAction(Request $request, $issue)
    {
        return $this->renderExtended('BackendBundle::home.html.twig', [
        ]);
    }

    public function updateAction(Request $request, $issue)
    {
        echo $issue;
        return $this->renderExtended('BackendBundle::home.html.twig', [
        ]);
    }

    public function deleteAction(Request $request, $issue)
    {
        return $this->renderExtended('BackendBundle::home.html.twig', [
        ]);
    }
}
