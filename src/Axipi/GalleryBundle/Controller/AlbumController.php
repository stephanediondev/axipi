<?php
namespace Axipi\GalleryBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class AlbumController extends AbstractController
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
