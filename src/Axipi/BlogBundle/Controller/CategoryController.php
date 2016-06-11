<?php
namespace Axipi\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function getPage($parameters)
    {
        $parameters->set('children', $this->get('axipi_core_manager_item')->getList(['parent' => $parameters->get('page'), 'active' => true]));

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
