<?php
namespace Axipi\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Entity\Item;

class DefaultExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('buildLink', [$this, 'buildLink'], array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('convertText', [$this, 'convertText'], array('is_safe' => array('html'))),
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('jsonDecode', [$this, 'jsonDecode']),
        ];
    }

    public function getWidget($id)
    {
        $content = '';
        $request = $this->container->get('request_stack')->getMasterRequest();
        $page = $this->container->get('axipi_core_manager_default')->getPage();

        $widget = $this->em->getRepository('AxipiCoreBundle:Item')->getOne(['category' => 'widget', 'active' => true, 'id' => $id]);

        if($this->container->has($widget->getComponent()->getService())) {
            $parameters = new ParameterBag();
            $parameters->set('request', $request);
            $parameters->set('widget', $widget);
            $parameters->set('page', $page);
            $content .= $this->container->get($widget->getComponent()->getService())->getWidget($parameters);
        }
        return $content;
    }

    public function getWidgets($code)
    {
        $content = '';
        $request = $this->container->get('request_stack')->getMasterRequest();
        $page = $this->container->get('axipi_core_manager_default')->getPage();

        $widgets = $this->em->getRepository('AxipiCoreBundle:Item')->getList(['category' => 'widget', 'active' => true, 'zone_code' => $code, 'language_code_or_language_null' => $page->getLanguage()->getCode()]);

        foreach($widgets as $widget) {
            if($this->container->has($widget->getComponent()->getService())) {
                $parameters = new ParameterBag();
                $parameters->set('request', $request);
                $parameters->set('widget', $widget);
                $parameters->set('page', $page);
                $content .= $this->container->get($widget->getComponent()->getService())->getWidget($parameters);
            }
        }
        return $content;
    }

    public function buildLink($page)
    {
        if($page instanceof Item) {
            $language = $page->getLanguage()->getCode();
            $slug = $page->getSlug();
        } else if(is_array($page)) {
            $language = $page['language'];
            $slug = $page['slug'];
        } else {
            $language = '';
            $slug = '';
        }

        $languages = $this->container->get('axipi_core_manager_default')->getLanguages();
        if(count($languages) > 1) {
            $url = $this->container->get('router')->generate('axipi_core_slug', array('slug' => $language.'/'.$slug), 0);
        } else {
            $url = $this->container->get('router')->generate('axipi_core_slug', array('slug' => $slug), 0);
        }

        return $url;
    }

    public function convertText($text)
    {
        $basePath = $this->container->get('request_stack')->getCurrentRequest()->getBasePath();
        $text = str_replace('src="../files/', 'src="'.$basePath.'/files/', $text);

        $ids = [];
        preg_match_all('/\[page:(\d*):(\S*)\]/im', $text, $matches, PREG_SET_ORDER);
        if(isset($matches) == 1) {
            foreach($matches as $match) {
                $ids[$match[1]] = $match[0];
            }
        }

        if(count($ids) > 0) {
            foreach($ids as $id => $tag) {
                $page = $this->em->getRepository('AxipiCoreBundle:Item')->getOne(['active' => true, 'id' => $id]);
                $url = $this->buildLink($page);
                $text = str_replace($ids[$id], $url, $text);
            }
        }

        $widgets = [];
        preg_match_all('/\[widget:(.*)\]/i', $text, $matches);
        if(isset($matches[1]) == 1) {
            $widgets = $matches[1];
        }

        if(count($widgets) > 0) {
            foreach($widgets as $widget) {
                $text = str_replace('<p>[widget:'.$widget.']</p>', '[widget:'.$widget.']', $text);
                $text = str_replace('[widget:'.$widget.']', $this->getWidget($widget), $text);
            }
        }

        return $text;
    }

    public function jsonDecode($data)
    {
        return json_decode($data, true);
    }
}
