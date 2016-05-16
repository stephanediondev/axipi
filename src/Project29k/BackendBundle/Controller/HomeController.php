<?php

namespace Project29k\BackendBundle\Controller;

use Project29k\CoreBundle\DependencyInjection\RenderTrait;

class HomeController
{
    use RenderTrait;

    public function indexAction()
    {
        $parameters = [];
        $parameters['objects'] = [['index' => 1], ['index' => 2], ['index' => 3], ['index' => 4]];

        return $this->renderExtended('BackendBundle::home.html.twig', $parameters);
    }
}
