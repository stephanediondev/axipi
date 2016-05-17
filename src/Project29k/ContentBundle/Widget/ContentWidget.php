<?php
namespace Project29k\ContentBundle\Widget;

use Project29k\CoreBundle\Widget\AbstractWidget;

class ContentWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('ContentBundle:Widget:content.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
