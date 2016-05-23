<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('AxipiContentBundle:Page:page.html.twig', ['page' => $page]);
    }
}
