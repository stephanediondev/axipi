<?php
namespace Axipi\GalleryBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    public function getPage($page)
    {
        return $this->render('AxipiGalleryBundle:Page:album.html.twig', ['page' => $page]);
    }
}
