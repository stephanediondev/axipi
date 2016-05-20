<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class LinkController extends AbstractController
{
    public function getPage($page)
    {
        return $this->redirect($page->getAttribute('url'));
    }
}
