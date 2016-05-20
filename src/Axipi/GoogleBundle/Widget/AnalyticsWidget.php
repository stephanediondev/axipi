<?php
namespace Axipi\GoogleBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class AnalyticsWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiGoogleBundle:Widget:analytics.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
