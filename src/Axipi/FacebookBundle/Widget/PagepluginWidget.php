<?php
namespace Axipi\FacebookBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class PagepluginWidget extends AbstractWidget
{
    public function getWidget($parameters)
    {
        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderView($template, $parameters->all());
    }
}
