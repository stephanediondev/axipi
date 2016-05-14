<?php

namespace Project29k\CoreBundle\Twig\Extension;

use Doctrine\ORM\EntityManagerInterface;

class CoreExtension extends \Twig_Extension
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core.twig.extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getWidgets', [$this, 'getWidgets']),
        ];
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
        ];
    }

    public function getWidgets($code)
    {
        return 'widgets: '.$code;
    }
}
