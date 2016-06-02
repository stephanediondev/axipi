<?php
namespace Axipi\CoreBundle\Widget;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractWidget extends Controller
{
    protected function renderWidget($view, array $parameters = array())
    {
        if (!$this->container->has('twig')) {
            throw new \LogicException('You can not use the "render" method if the Templating Component or the Twig Bundle are not available.');
        }

        $content = $this->container->get('twig')->render($view, $parameters);

        return $content;
    }
}
