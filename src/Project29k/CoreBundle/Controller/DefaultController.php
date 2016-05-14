<?php

namespace Project29k\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

use Project29k\CoreBundle\Manager\CoreManager;
use Project29k\CoreBundle\Shared\RenderShared;

class DefaultController
{
    use RenderShared;

    protected $coreManager;

    public function __construct(
        CoreManager $coreManager
    ) {
        $this->coreManager = $coreManager;
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
        return $this->render('CoreBundle:default:index.html.twig', [
        ]);
    }

    public function createAction(Request $request)
    {
        return $this->render('CoreBundle:default:index.html.twig', [
        ]);
    }

    public function readAction(Request $request, $issue)
    {
        return $this->render('CoreBundle:default:index.html.twig', [
        ]);
    }

    public function updateAction(Request $request, $issue)
    {
        echo $issue;
        return $this->render('CoreBundle:default:index.html.twig', [
        ]);
    }

    public function deleteAction(Request $request, $issue)
    {
        return $this->render('CoreBundle:default:index.html.twig', [
        ]);
    }
}
