<?php
namespace Axipi\GoogleBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class MapWidget extends AbstractWidget
{
    public function getWidget($parameters)
    {
        $parameters->set('markers', $this->get('axipi_core_manager_item')->getList(['parent' => $parameters->get('widget'), 'active' => true]));

        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderWidget($template, $parameters->all());
    }
}
