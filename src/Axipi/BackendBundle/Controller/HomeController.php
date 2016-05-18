<?php

namespace Axipi\BackendBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        $parameters = [];
        return $this->render('AxipiBackendBundle::home.html.twig', $parameters);
    }
}
