<?php
namespace Project29k\CoreBundle\Shared;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

trait RenderShared
{
    /**
     * @var EngineInterface
     */
    private $engineInterface;

    /**
     * @param EngineInterface $engineInterface
     */
    public function setEngineInterface(EngineInterface $engineInterface)
    {
        $this->engineInterface = $engineInterface;
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
