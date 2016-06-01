<?php
namespace Axipi\SitemapBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class XmlController extends AbstractController
{
    public function getPage(Request $request, $page)
    {
        $parameters = new ParameterBag();
        $parameters->set('request', $request);
        $parameters->set('page', $page);
        $parameters->set('results', $this->get('axipi_core_manager_item')->getList(['category' => 'page', 'exclude_sitemap' => true, 'active' => true]));

        if($page->getTemplate()) {
            $template = $page->getTemplate();
        } else {
            $template = $page->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        $response->headers->set('Content-Type', 'text/xml');
        return $response;
    }
}
