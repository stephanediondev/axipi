<?php
namespace Axipi\SitemapBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class XmlController extends AbstractController
{
    public function getPage($page)
    {
        if($page->getTemplate()) {
            $template = $page->getTemplate();
        } else {
            $template = $page->getComponent()->getTemplate();
        }
        $response = $this->render($template, ['page' => $page]);
        $response->headers->set('Content-Type', 'text/xml');
        return $response;
    }
}
