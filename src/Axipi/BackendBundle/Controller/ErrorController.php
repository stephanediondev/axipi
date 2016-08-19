<?php

namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Axipi\CoreBundle\Controller\AbstractController;

class ErrorController extends AbstractController
{
    public function indexAction($code)
    {
        $response = new Response();
        $response->setStatusCode($code);
        return $this->render('AxipiBackendBundle::Error/'.$code.'.html.twig', [], $response);
    }
}
