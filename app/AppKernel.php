<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),

            new Axipi\CoreBundle\AxipiCoreBundle(),
            new Axipi\BackendBundle\AxipiBackendBundle(),
            new Axipi\AppBundle\AxipiAppBundle(),
            new Axipi\ContentBundle\AxipiContentBundle(),
            new Axipi\SchemaBundle\AxipiSchemaBundle(),
            new Axipi\ContactBundle\AxipiContactBundle(),
            new Axipi\SearchBundle\AxipiSearchBundle(),
            new Axipi\SitemapBundle\AxipiSitemapBundle(),
            new Axipi\BlogBundle\AxipiBlogBundle(),
            new Axipi\GalleryBundle\AxipiGalleryBundle(),
            new Axipi\GoogleBundle\AxipiGoogleBundle(),
            new Axipi\TwitterBundle\AxipiTwitterBundle(),
            new Axipi\FacebookBundle\AxipiFacebookBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
