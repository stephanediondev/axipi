<?php

namespace Project29k\CoreBundle\Controller;

use Project29k\CoreBundle\DependencyInjection\RenderTrait;

class ContentController
{
    use RenderTrait;

    public function pageAction($object)
    {
        return $this->renderExtended('CoreBundle:default:content.html.twig', ['object' => $object]);
    }

    public function widgetAction($object)
    {
        return $this->contentExtended('CoreBundle:default:content.html.twig', ['object' => $object]);
    }
}
