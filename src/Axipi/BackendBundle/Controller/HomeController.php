<?php

namespace Axipi\BackendBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        $parameterBag = [];
        return $this->render('AxipiBackendBundle::Home/index.html.twig', $parameterBag);
    }
}
