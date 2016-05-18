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
        $page = $this->container->get('core.manager')->getPage();

        $widget = new Widget();
        $widget->setTitle($code);

        $service = 'content.widget';
        if($this->container->has($service)) {
            return $this->container->get('content.widget')->getWidget($widget, $page);
        }
    }
}
