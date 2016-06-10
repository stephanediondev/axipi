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
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters);
            case 'apcu':
                return $this->apcuAction($request, $parameters);
            case 'opcache':
                return $this->opcacheAction($request, $parameters);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_cache', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $parameters->set('apcu', function_exists('apcu_clear_cache'));
        $parameters->set('opcache', function_exists('opcache_reset'));

        return $this->render('AxipiBackendBundle::cache.html.twig', $parameters->all());
    }

    public function apcuAction(Request $request, ParameterBag $parameters)
    {
        if(function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
            $this->addFlash('success', 'done');
        }

        return $this->redirectToRoute('axipi_backend_cache', []);
    }

    public function opcacheAction(Request $request, ParameterBag $parameters)
    {
        if(function_exists('opcache_reset')) {
            opcache_reset();
            $this->addFlash('success', 'done');
        }

        return $this->redirectToRoute('axipi_backend_cache', []);
    }
}
