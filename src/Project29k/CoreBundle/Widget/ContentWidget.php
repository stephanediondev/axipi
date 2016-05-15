<?php

namespace Project29k\CoreBundle\Widget;

use Project29k\CoreBundle\DependencyInjection\RenderTrait;

class ContentWidget
{
    use RenderTrait;

    public function get($widget, $page)
    {
        return $this->contentExtended('CoreBundle:Widget:content.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
