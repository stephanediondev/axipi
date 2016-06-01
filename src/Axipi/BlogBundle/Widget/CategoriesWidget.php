<?php
namespace Axipi\BlogBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class CategoriesWidget extends AbstractWidget
{
    public function getWidget(Request $request, $widget, $page)
    {
        $parameters = new ParameterBag();
        $parameters->set('request', $request);
        $parameters->set('widget', $widget);
        $parameters->set('page', $page);
        $parameters->set('children', $this->get('axipi_core_manager_item')->getList(['parent' => $widget->getParent(), 'category' => 'page', 'active' => true]));

        if($widget->getTemplate()) {
            $template = $widget->getTemplate();
        } else {
            $template = $widget->getComponent()->getTemplate();
        }
        return $this->render($template, $parameters->all());
    }
}
