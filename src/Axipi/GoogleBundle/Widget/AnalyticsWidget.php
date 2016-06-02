<?php
namespace Axipi\GoogleBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class AnalyticsWidget extends AbstractWidget
{
    public function getWidget(Request $request, $widget, $page)
    {
        $parameters = new ParameterBag();
        $parameters->set('request', $request);
        $parameters->set('widget', $widget);
        $parameters->set('page', $page);

        if($widget->getTemplate()) {
            $template = $widget->getTemplate();
        } else {
            $template = $widget->getComponent()->getTemplate();
        }
        return $this->renderWidget($template, $parameters->all());
    }
}
