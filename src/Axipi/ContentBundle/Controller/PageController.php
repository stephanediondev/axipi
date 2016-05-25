<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    public function getPage($page)
    {
        if($page->getTemplate()) {
            $template = $page->getTemplate();
        } else {
            $template = $page->getComponent()->getTemplate();
        }
        return $this->render($template, ['page' => $page]);
    }
}
