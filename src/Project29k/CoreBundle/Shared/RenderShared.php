<?php
namespace Project29k\CoreBundle\Shared;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

trait RenderShared
{
    /**
     * @var EngineInterface
     */
    private $engineInterface;

    /**
     * @var HttpKernelInterface
     */
    protected $httpKernel;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param EngineInterface $engineInterface
     */
    public function setEngineInterface(EngineInterface $engineInterface)
    {
        $this->engineInterface = $engineInterface;
    }

    /**
     * @param HttpKernelInterface $httpKernel
     */
    public function setHttpKernel(HttpKernelInterface $httpKernel)
    {
        $this->httpKernel = $httpKernel;
    }

    /**
     * @param RequestStack $requestStack
     */
    public function setRequestStack(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param string             $template
     * @param \Traversable|Array $parameters
     * @param int                $httpCode
     *
     * @return Response
     */
    public function renderExtended($template, $parameters = [], $httpCode = 200)
    {
        if ($parameters instanceof \IteratorAggregate) {
            $parameters = $parameters->getIterator();
        }

        if ($parameters instanceof \Iterator) {
            $parameters = iterator_to_array($parameters);
        }

        $content = $this->engineInterface->render($template, $parameters);
        //$content = '';print_r($parameters);

        $response = new Response($content, $httpCode);

        return $response;
    }

    /**
     * Forwards the request to another controller.
     *
     * @param string $controller The controller name (a string like BlogBundle:Post:index)
     * @param array  $path       An array of path parameters
     * @param array  $query      An array of query parameters
     *
     * @return Response A Response instance
     */
    public function forwardExtented($controller, array $path = array(), array $query = array())
    {
        $path['_controller'] = $controller;

        $subRequest = $this->requestStack->getCurrentRequest()->duplicate($query, null, $path);

        return $this->httpKernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }
}
