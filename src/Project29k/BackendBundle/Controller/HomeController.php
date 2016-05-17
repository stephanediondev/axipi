<?php

namespace Project29k\BackendBundle\Controller;

use Project29k\CoreBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        $parameters = [];
        return $this->render('BackendBundle::home.html.twig', $parameters);
    }
}
