<?php
namespace Axipi\ContentBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class BreadcrumbsWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiContentBundle:Widget:breadcrumbs.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
