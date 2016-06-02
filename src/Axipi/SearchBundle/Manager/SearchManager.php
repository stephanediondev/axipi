<?php
namespace Axipi\SearchBundle\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\Item;

class SearchManager extends AbstractManager
{
    protected $elasticsearchEnabled;

    protected $elasticsearchIndex;

    protected $elasticsearchUrl;

    public function setElasticSearch($enabled, $index, $url)
    {
        $this->elasticsearchEnabled = $enabled;
        $this->elasticsearchIndex = $index;
        $this->elasticsearchUrl = $url;
    }

    public function getSearchIndex()
    {
        return $this->elasticsearchIndex;
    }

    public function indexPage($data)
    {
        if($data->getExcludeSearch() || $data->getComponent()->getExcludeSearch()) {
            $action = 'DELETE';

        } else if($data->getIsActive()) {
            $action = 'PUT';

        } else {
            $action = 'DELETE';
        }

        $path = '/'.$this->elasticsearchIndex.'/page/'.$data->getId();

        $body = array(
            'language' => array(
                'code' => $data->getLanguage()->getCode(),
                'title' => $data->getLanguage()->getTitle(),
            ),
            'component' => array(
                'service' => $data->getComponent()->getService(),
                'icon' => $data->getComponent()->getIcon(),
            ),
            'title' => strip_tags($data->getTitle()),
            'slug' => $data->getSlug(),
            'description' => strip_tags($data->getAttribute('description')),
        );
        if($data->getParent()) {
            $body['parent'] = array(
                'title' => $data->getParent()->getTitle(),
                'slug' => $data->getParent()->getSlug(),
            );
        }
        $this->search($action, $path, $body);
    }

    public function search($action, $path, $body = false)
    {
        if($this->elasticsearchEnabled) {
            $path = $this->elasticsearchUrl.$path;

            $ci = curl_init();
            curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $action);
            curl_setopt($ci, CURLOPT_URL, $path);
            if($body) {
                curl_setopt($ci, CURLOPT_POSTFIELDS, json_encode($body));
            }
            $result = json_decode(curl_exec($ci), true);
            if($action == 'HEAD') {
                $result = curl_getinfo($ci, CURLINFO_HTTP_CODE);
            }
            return $result;
        }
    }

    public function indexAll()
    {
        $pages = $this->em->getRepository('AxipiCoreBundle:Item')->getList(['category' => 'page']);
        foreach($pages as $page) {
            $this->indexPage($page);
        }
    }
}