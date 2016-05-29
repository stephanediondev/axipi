<?php
namespace Axipi\SearchBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class FormWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        if($widget->getTemplate()) {
            $template = $widget->getTemplate();
        } else {
            $template = $widget->getComponent()->getTemplate();
        }
        return $this->render($template, ['widget' => $widget, 'page' => $page]);
    }
}
