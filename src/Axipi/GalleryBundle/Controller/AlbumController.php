<?php
namespace Axipi\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class AlbumController extends AbstractController
{
    public function getPage($parameters)
    {
        $parameters->set('albums', $this->get('axipi_core_manager_item')->getList(['component_service' => 'axipi_gallery_controller_album', 'parent' => $parameters->get('page'), 'active' => true]));

        $parameters->set('medias', $this->get('axipi_core_manager_item')->getList(['component_service' => 'axipi_gallery_controller_media', 'parent' => $parameters->get('page'), 'active' => true]));

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
