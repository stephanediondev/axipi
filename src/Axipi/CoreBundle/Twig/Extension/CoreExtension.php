<?php

namespace Axipi\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;

use Axipi\CoreBundle\Entity\Page;
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
            new \Twig_SimpleFunction('convertText', [$this, 'convertText'], array('is_safe' => array('html'))),
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
        $page = $this->container->get('axipi_core_manager_core')->getPage();

        $widgets = $this->em->getRepository('AxipiCoreBundle:Zone')->getWidgets($code);

        foreach($widgets as $widget) {
            if($this->container->has($widget->getComponent()->getService())) {
                $content .= $this->container->get($widget->getComponent()->getService())->getWidget($widget, $page);
            }
        }
        return $content;
    }

    public function convertText($text)
    {
        $ids = [];
        preg_match_all('/\[page:(\d*):(\S*)\]/im', $text, $matches, PREG_SET_ORDER);
        if(isset($matches) == 1) {
            foreach($matches as $match) {
                $ids[$match[1]] = $match[0];
            }
        }

        if(count($ids) > 0) {
            $pages = $this->em->getRepository('AxipiCoreBundle:Page')->getConvertPages(array_keys($ids));
            if($pages) {
                foreach($pages as $page) {
                    $url = $this->container->get('router')->generate('axipi_core_slug', array('slug' => $page->getSlug()), 0);
                    $text = str_replace($ids[$page->getId()], $url, $text);
                }
            }
        }

        $widgets = [];
        preg_match_all('/\[widgets:(.*)\]/i', $text, $matches);
        if(isset($matches[1]) == 1) {
            $widgets = $matches[1];
        }
        if(count($ids) > 0) {
            foreach($widgets as $widget) {
                $text = str_replace('<p>[widgets:'.$widget.']</p>', '[widgets:'.$widget.']', $text);
                $text = str_replace('[widgets:'.$widget.']', $this->getWidgets($widget), $text);
            }
        }

        return $text;
    }
}
