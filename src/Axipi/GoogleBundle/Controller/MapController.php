<?php
namespace Axipi\GoogleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class MapController extends AbstractController
{
    public function getPage($parameters)
    {
        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
