<?php
namespace Axipi\GalleryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class MediaController extends AbstractController
{
    public function getPage(Request $request, ParameterBag $parameters)
    {
        $parameters->set('albums', $this->get('axipi_core_manager_item')->getList(['component_service' => 'axipi_gallery_controller_album', 'language_code' => $parameters->get('page')->getLanguage()->getCode(), 'active' => true]));

        $parameters->set('previous', $this->get('axipi_core_manager_item')->getOne(['parent' => $parameters->get('page')->getParent(), 'previous_id' => $parameters->get('page')->getId(), 'active' => true]));
        $parameters->set('next', $this->get('axipi_core_manager_item')->getOne(['parent' => $parameters->get('page')->getParent(), 'next_id' => $parameters->get('page')->getId(), 'active' => true]));

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        return $this->render($template, $parameters->all());
    }
}
