<?php
namespace Axipi\ContentBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class IconWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiContentBundle:Widget:icon.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
