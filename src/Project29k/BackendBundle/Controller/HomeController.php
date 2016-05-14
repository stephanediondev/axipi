<?php

namespace Project29k\BackendBundle\Controller;

use Project29k\CoreBundle\Shared\RenderShared;

class HomeController
{
    use RenderShared;

    public function indexAction($object)
    {
        return $this->renderExtended('BackendBundle::home.html.twig', ['object' => $object]);
    }
}
