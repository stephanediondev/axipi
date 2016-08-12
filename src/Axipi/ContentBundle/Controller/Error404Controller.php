<?php
namespace Axipi\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class Error404Controller extends AbstractController
{
    public function getPage(Request $request, ParameterBag $parameters)
    {
        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = new Response();
        $response->setStatusCode(404);
        return $this->render($template, $parameters->all(), $response);
    }
}
