<?php
namespace Axipi\TwitterBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class CardWidget extends AbstractWidget
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
