<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

use CoreBundle\Manager\CoreManager;

class DefaultController
{
    protected $coreManager;
    protected $engineInterface;

    public function __construct(
        CoreManager $coreManager,
        EngineInterface $engineInterface
    ) {
        $this->coreManager = $coreManager;
        $this->engineInterface = $engineInterface;
    }

    /**
     * @param Request $request
     * @param string $action
     * @param integer|null $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
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

    /**
     * @param string             $template
     * @param \Traversable|Array $parameters
     * @param int                $httpCode
     *
     * @return Response
     */
    public function render($template, $parameters = [], $httpCode = 200)
    {
        if ($parameters instanceof \IteratorAggregate) {
            $parameters = $parameters->getIterator();
        }

        if ($parameters instanceof \Iterator) {
            $parameters = iterator_to_array($parameters);
        }

        $content = $this->engineInterface->render($template, $parameters);

        $response = new Response($content, $httpCode);

        return $response;
    }
}
