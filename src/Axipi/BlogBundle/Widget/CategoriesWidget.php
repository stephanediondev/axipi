<?php
namespace Axipi\BlogBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class CategoriesWidget extends AbstractWidget
{
    public function getWidget(Request $request, ParameterBag $parameters)
    {
        $parameters->set('children', $this->get('axipi_core_manager_item')->getList(['parent' => $parameters->get('widget')->getParent(), 'category' => 'page', 'active' => true]));

        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderView($template, $parameters->all());
    }
}
