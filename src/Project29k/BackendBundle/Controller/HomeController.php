<?php

namespace Project29k\BackendBundle\Controller;

use Project29k\CoreBundle\DependencyInjection\RenderTrait;

class HomeController
{
    use RenderTrait;

    public function indexAction()
    {
        return $this->renderExtended('BackendBundle::home.html.twig');
    }
}
