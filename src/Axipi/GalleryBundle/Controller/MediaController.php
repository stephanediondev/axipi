<?php
namespace Axipi\GalleryBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class MediaController extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('AxipiGalleryBundle:Page:media.html.twig', ['page' => $page]);
    }
}
