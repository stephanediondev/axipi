<?php
namespace Axipi\ContentBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class LanguageselectorWidget extends AbstractWidget
{
    public function getWidget(Request $request, ParameterBag $parameters)
    {
        $parameters->set('languages', $this->get('axipi_core_manager_default')->getLanguages());

        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderView($template, $parameters->all());
    }
}
