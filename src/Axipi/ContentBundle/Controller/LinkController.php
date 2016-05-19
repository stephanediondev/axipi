<?php
namespace Axipi\ContentBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class ContentController extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('AxipiContentBundle::content.html.twig', ['page' => $page]);
    }
}
