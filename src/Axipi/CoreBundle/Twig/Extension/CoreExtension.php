<?php

namespace Axipi\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

use Axipi\CoreBundle\Entity\Widget;

class CoreExtension extends \Twig_Extension
{
    protected $container;

    protected $em;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getName()
    {
        return 'core.twig.extension';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getWidgets', [$this, 'getWidgets'], array('is_safe' => array('html'))),
        ];
    }

    public function getFilters()
    {
        return [
        ];
    }

    public function getWidgets($code)
    {
        $content = '';
        $page = $this->container->get('core.manager')->getPage();

        $widgets = $this->em->getRepository('AxipiCoreBundle:Page')->getWidgets($code);

        foreach($widgets as $widget) {
            if($this->container->has($widget->getComponent()->getService())) {
                $content .= $this->container->get($widget->getComponent()->getService())->getWidget($widget, $page);
            }
        }
        return $content;
    }
}
