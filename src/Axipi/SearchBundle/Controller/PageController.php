<?php
namespace Axipi\SearchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\SearchBundle\Manager\SearchManager;

class PageController extends AbstractController
{
    protected $searchManager;

    public function __construct(
        SearchManager $searchManager
    ) {
        $this->searchManager = $searchManager;
    }

    public function getPage($parameters)
    {
        $data = [];
        $data['sort_field'] = array('date.sort' => 'Date', '_score' => 'Score', 'title.sort' => 'Title');
        $data['sort_direction'] = array('asc' => 'Asc.', 'desc' => 'Desc.',);

        if($parameters->get('request')->query->get('q')) {
            if(!array_key_exists($parameters->get('request')->query->get('sort_field'), $data['sort_field'])) {
                $sort_field = '_score';
            } else {
                $sort_field = $parameters->get('request')->query->get('sort_field');
            }
            if(!array_key_exists($parameters->get('request')->query->get('sort_direction'), $data['sort_direction'])) {
                $sort_direction = 'desc';
            } else {
                $sort_direction = $parameters->get('request')->query->get('sort_direction');
            }

            $size = 20;
            $from = $parameters->get('request')->query->get('from', 0);
            $path = '/'.$this->searchManager->getIndex().'/_search?size='.intval($size).'&type=page&from='.intval($from);

            $body = array();
            $body['sort'] = array(
                $sort_field => array(
                    'order' => $sort_direction,
                    ),
            );
            $body['query'] = array(
                'query_string' => array(
                    'fields' => array('title', 'description'),
                    'query' => $parameters->get('request')->query->get('q'),
                ),
            );
            $body['highlight'] = array(
                //'encoder' => 'html',
                'pre_tags' => array('<strong>'),
                'post_tags' => array('</strong>'),
                'fields' => array(
                    'title' => array(
                        'fragment_size' => 255,
                        'number_of_fragments' => 1,
                    ),
                    'description' => array(
                        'fragment_size' => 500,
                        'number_of_fragments' => 1,
                    ),
                ),
            );

            if(!$parameters->get('page')->getAttribute('all_languages')) {
                $body['filter'] = array(
                    'term' => array(
                        'language.code' => $parameters->get('page')->getLanguage()->getCode(),
                    ),
                );
            }

            /*if($parameters->get('request')->query->get('date_from') && $parameters->get('request')->query->get('date_to')) {
                $body['filter'] = array(
                    'range' => array(
                        'date.sort' => array(
                            'gte' => $parameters->get('request')->query->get('date_from'),
                            'lte' => $parameters->get('request')->query->get('date_to'),
                            'format' => 'YYYY-MM-DD',
                        ),
                    ),
                );
            }*/

            $result = $this->searchManager->query('GET', $path, $body);

            if(isset($result->error) == 0) {
                $parameters->set('hits', $result['hits']);

                $pagination = [];
                if($result['hits']['total'] > $size) {
                    $total = $result['hits']['total'] - 1;
                    $start = 1;
                    for($i=0;$i<=$total;$i = $i + $size) {
                        $pagination[$start] = $i;
                        $start++;
                    }
                    $parameters->set('current_from', intval($from));
                }
                $parameters->set('pagination', $pagination);
            }
        }

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
