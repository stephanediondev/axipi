<?php
namespace Axipi\ContentBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class BlockWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiContentBundle:Widget:block.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
