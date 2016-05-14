<?php

namespace Project29k\BackendBundle\Controller;

use Project29k\CoreBundle\Shared\RenderShared;

class HomeController
{
    use RenderShared;

    public function indexAction()
    {
        return $this->renderExtended('BackendBundle::home.html.twig');
    }
}
