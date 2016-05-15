<?php

namespace Project29k\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

use Project29k\CoreBundle\Entity\Object;

class CoreExtension extends \Twig_Extension
{
    protected $em;

    protected $container;

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

        $widget = new Object();
        $widget->setTitle($code);

        return $this->container->get('core.content_widget')->get($widget, $page);
        return 'widgets: '.$code;
    }
}
