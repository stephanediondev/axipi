<?php
namespace Axipi\ContentBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class ContentWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiContentBundle:Widget:content.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
