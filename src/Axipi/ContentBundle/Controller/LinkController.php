<?php
namespace Axipi\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class LinkController extends AbstractController
{
    public function getPage($parameters)
    {
        return $this->redirect($parameters->get('page')->getAttribute('url'));
    }
}
