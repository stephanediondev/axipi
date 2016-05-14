<?php

namespace Project29k\CoreBundle\Controller;

use Project29k\CoreBundle\Shared\RenderShared;

class ContentController
{
    use RenderShared;

    public function indexAction($object)
    {
        return $this->renderExtended('CoreBundle:default:content.html.twig', ['object' => $object]);
    }
}
