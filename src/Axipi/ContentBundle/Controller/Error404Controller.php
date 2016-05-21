<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class Error404Controller extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('AxipiContentBundle:Page:error404.html.twig', ['page' => $page]);
    }
}
