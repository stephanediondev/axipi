<?php
namespace Axipi\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function getPage($parameters)
    {
        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['widgetParameterName' => 'page']);
        $pagination = $paginator->paginate(
            $this->get('axipi_core_manager_item')->getList(['component_service' => 'axipi_blog_controller_post', 'parent' => $parameters->get('page'), 'active' => true]),
            $parameters->get('request')->query->getInt('page', 1),
            20
        );
        $parameters->set('posts', $pagination);

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
