<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class Error404Controller extends AbstractController
{
    public function getPage($page)
    {
        if($page->getTemplate()) {
            $template = $page->getTemplate();
        } else {
            $template = $page->getComponent()->getTemplate();
        }
        $response = $this->render($template, ['page' => $page]);
        $response->setStatusCode(404);
        return $response;
    }
}
