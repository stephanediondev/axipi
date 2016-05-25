<?php
namespace Axipi\GoogleBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class MapController extends AbstractController
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
