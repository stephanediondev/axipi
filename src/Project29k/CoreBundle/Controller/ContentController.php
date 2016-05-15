<?php

namespace Project29k\CoreBundle\Controller;

use Project29k\CoreBundle\DependencyInjection\RenderTrait;

class ContentController
{
    use RenderTrait;

    public function indexAction($object)
    {
        return $this->renderExtended('CoreBundle::content.html.twig', ['object' => $object]);
    }
}
