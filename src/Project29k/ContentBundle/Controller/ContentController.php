<?php
namespace Project29k\ContentBundle\Controller;

use Project29k\CoreBundle\Controller\AbstractController;

class ContentController extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('ContentBundle::content.html.twig', ['page' => $page]);
    }
}
