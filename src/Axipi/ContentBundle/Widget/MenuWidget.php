<?php
namespace Axipi\ContentBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class MenuWidget extends AbstractWidget
{
    public function getWidget($parameters)
    {
        $parameters->set('relations', $this->get('axipi_core_manager_relation')->getList(['widget' => $parameters->get('widget'), 'active' => true]));

        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderWidget($template, $parameters->all());
    }
}
