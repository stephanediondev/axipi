<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('AxipiContentBundle:Page:home.html.twig', ['page' => $page]);
    }
}
