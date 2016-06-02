<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\SearchBundle\Manager\SearchManager;

class SearchController extends AbstractController
{
    protected $searchManager;

    public function __construct(
        SearchManager $searchManager
    ) {
        $this->searchManager = $searchManager;
    }

    public function dispatchAction(Request $request, $action)
    {
        if(!$this->isGranted('ROLE_PAGES')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters);
            case 'init':
                return $this->initAction($request, $parameters);
            case 'scan':
                return $this->scanAction($request, $parameters);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_search', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters)
    {
        $path = '/'.$this->searchManager->getSearchIndex().'/_stats';
        $result = $this->searchManager->query('GET', $path);
        if(isset($result->error) == 0) {
            $parameters->set('stats', $result);
        }

        $path = '/_cluster/health';
        $result = $this->searchManager->query('GET', $path);
        if(isset($result->error) == 0) {
            $parameters->set('health', $result);
        }

        $path = '/_nodes';
        $result = $this->searchManager->query('GET', $path);
        if(isset($result->error) == 0) {
            $parameters->set('nodes', $result);
        }

        return $this->render('AxipiBackendBundle:Search:index.html.twig', $parameters->all());
    }

    public function initAction(Request $request, ParameterBag $parameters)
    {
        $path = '/'.$this->searchManager->getSearchIndex();
        $result = $this->searchManager->query('HEAD', $path);

        if($result == 404) {
            $path = '/'.$this->searchManager->getSearchIndex();
            $result = $this->searchManager->query('PUT', $path);
        }

        $path = '/'.$this->searchManager->getSearchIndex().'/_close';
        $result = $this->searchManager->query('POST', $path);

        $path = '/'.$this->searchManager->getSearchIndex().'/_settings';
        $body = array(
            'settings' => array(
                'index' => array(
                    'analysis' => array(
                        'analyzer' => array(
                            'case_insensitive_sort' => array(
                                'filter' => array(
                                    'lowercase',
                                    'asciifolding',
                                ),
                                'tokenizer' => 'keyword',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $result = $this->searchManager->query('PUT', $path, $body);

        $path = '/'.$this->searchManager->getSearchIndex().'/_open';
        $result = $this->searchManager->query('POST', $path);

        $path = '/'.$this->searchManager->getSearchIndex().'/_mapping/page';
        $body = array(
            'page' => array(
                'properties' => array( 
                    'title' => array( 
                        'type' => 'string',
                        'fields' => array(
                            'sort' => array( 
                                'type' => 'string',
                                'analyzer' => 'case_insensitive_sort',
                            ),
                        ),
                    ),
                    'date' => array( 
                        'type' => 'string',
                        'fields' => array(
                            'sort' => array( 
                                'type' => 'string',
                                'analyzer' => 'case_insensitive_sort',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $result = $this->searchManager->query('PUT', $path, $body);

        return $this->redirectToRoute('axipi_backend_search', []);
    }

    public function scanAction(Request $request, ParameterBag $parameters)
    {
        $this->searchManager->indexAll();

        return $this->redirectToRoute('axipi_backend_search', []);
    }
}
