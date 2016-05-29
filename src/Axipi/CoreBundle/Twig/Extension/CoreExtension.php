<?php

namespace Axipi\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
//use Twig_Extension_StringLoader;

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
            new \Twig_SimpleFunction('renderString', [$this, 'renderString'], array('needs_environment' => true)),
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
        preg_match_all('/\[page_(.*)\]/i', $text, $matches);
        if(isset($matches[1]) == 1) {
            $ids = $matches[1];
        }

        $pages = $this->em->getRepository('AxipiCoreBundle:Page')->getConvertPages(array_values($ids));

        foreach($pages as $page) {
            echo $page->getId();
            $text = str_replace('[page_'.$page->getId().']', $page->getSlug(), $text);
        }
        return $text;
    }

    public function renderString(\Twig_Environment $env, $template)
    {
        /*$this->addClassesToCompile(array(
            'Twig_Extension_StringLoader',
        ));*/

        $env = new \Twig_Environment(new \Twig_Loader_String());
        return $env->render($template);

        //return $template;
        //return parent::render($template);
        //return template_from_string($env, (string) $template);
        //return $env->createTemplate((string) $template);
        return $env->createTemplate('oo');
    }
}
