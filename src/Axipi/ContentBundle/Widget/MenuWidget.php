<?php
namespace Axipi\ContentBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;

class MenuWidget extends AbstractWidget
{
    public function getWidget($parameters)
    {
        $results = $this->get('axipi_core_manager_relation')->getList(['widget' => $parameters->get('widget'), 'active' => true]);

        $relations = [];
        foreach($results as $rel) {
            if($rel->getParent()) {
                $relations[$rel->getParent()->getId()][] = $rel;
            } else {
                $relations['null'][] = $rel;
            }
        }

        $parameters->set('relations', $relations);

        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderWidget($template, $parameters->all());
    }
}
