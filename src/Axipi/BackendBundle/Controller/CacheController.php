<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\CacheManager;

class CacheController extends AbstractController
{
    protected $cacheManager;

    public function __construct(
        CacheManager $cacheManager
    ) {
        $this->cacheManager = $cacheManager;
    }

    public function dispatchAction(Request $request, $action)
    {
        if(!$this->isGranted('ROLE_CACHE')) {
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameterBag);
            case 'symfony':
                return $this->symfonyAction($request, $parameterBag);
            case 'mediacache':
                return $this->mediacacheAction($request, $parameterBag);
            case 'apcu':
                return $this->apcuAction($request, $parameterBag);
            case 'opcache':
                return $this->opcacheAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('mediacache', is_dir('media'));
        $parameterBag->set('apcu', function_exists('apcu_clear_cache'));
        $parameterBag->set('opcache', function_exists('opcache_reset'));

        return $this->render('AxipiBackendBundle::Cache/index.html.twig', $parameterBag->all());
    }

    public function symfonyAction(Request $request, ParameterBag $parameterBag)
    {
        $realCacheDir = $this->getParameter('kernel.cache_dir');
        $oldCacheDir = substr($realCacheDir, 0, -1).('~' === substr($realCacheDir, -1) ? '+' : '~');
        $filesystem = $this->get('filesystem');

        if(!is_writable($realCacheDir)) {
            throw new \RuntimeException(sprintf('Unable to write in the "%s" directory', $realCacheDir));
        }

        if($filesystem->exists($oldCacheDir)) {
            $filesystem->remove($oldCacheDir);
        }

        $this->get('cache_clearer')->clear($realCacheDir);

        $filesystem->rename($realCacheDir, $oldCacheDir);

        $filesystem->remove($oldCacheDir);

        $this->addFlash('success', 'Reset Symfony done');

        return $this->redirectToRoute('axipi_backend_cache', []);
    }

    public function mediacacheAction(Request $request, ParameterBag $parameterBag)
    {
        $realCacheDir = 'media';
        $oldCacheDir = substr($realCacheDir, 0, -1).('~' === substr($realCacheDir, -1) ? '+' : '~');
        $filesystem = $this->get('filesystem');

        if(!is_writable($realCacheDir)) {
            throw new \RuntimeException(sprintf('Unable to write in the "%s" directory', $realCacheDir));
        }

        if($filesystem->exists($oldCacheDir)) {
            $filesystem->remove($oldCacheDir);
        }

        $this->get('cache_clearer')->clear($realCacheDir);

        $filesystem->rename($realCacheDir, $oldCacheDir);

        $filesystem->remove($oldCacheDir);

        $this->addFlash('success', 'Reset Media cache done');

        return $this->redirectToRoute('axipi_backend_cache', []);
    }

    public function apcuAction(Request $request, ParameterBag $parameterBag)
    {
        if(function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
            $this->addFlash('success', 'Reset APCu done');
        }

        return $this->redirectToRoute('axipi_backend_cache', []);
    }

    public function opcacheAction(Request $request, ParameterBag $parameterBag)
    {
        if(function_exists('opcache_reset')) {
            opcache_reset();
            $this->addFlash('success', 'Reset OPcache done');
        }

        return $this->redirectToRoute('axipi_backend_cache', []);
    }
}
