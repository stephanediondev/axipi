<?php
namespace Axipi\GoogleBundle\Widget;

use Axipi\CoreBundle\Widget\AbstractWidget;

class SearchconsoleWidget extends AbstractWidget
{
    public function getWidget($widget, $page)
    {
        return $this->render('AxipiGoogleBundle:Widget:searchconsole.html.twig', ['widget' => $widget, 'page' => $page]);
    }
}
