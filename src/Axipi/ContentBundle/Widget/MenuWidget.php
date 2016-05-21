<?php
namespace Axipi\ContentBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class MenuWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiContentBundle:Widget:menu.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
