<?php
namespace Axipi\SitemapBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class XmlController extends AbstractController
{
    public function getPage(Request $request, ParameterBag $parameters)
    {
        $filters = [];
        $filters['category'] = 'page';
        $filters['exclude_sitemap'] = true;
        $filters['active'] = true;
        if(count($parameters->get('languages')) > 1) {
            $filters['language_code'] = $parameters->get('page')->getLanguage()->getCode();
        }
        $parameters->set('results', $this->get('axipi_core_manager_item')->getList($filters));

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        return $this->render($template, $parameters->all(), $response);
    }
}
