<?php
namespace Axipi\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class MediaController extends AbstractController
{
    public function getPage($parameters)
    {
        $parameters->set('albums', $this->get('axipi_core_manager_item')->getList(['component_service' => 'axipi_gallery_controller_album', 'language_code' => $parameters->get('page')->getLanguage()->getCode(), 'active' => true]));

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
