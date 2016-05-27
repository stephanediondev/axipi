<?php

namespace Axipi\CoreBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractManager
{
    protected $em;

    protected $elasticsearchEnabled;

    protected $elasticsearchIndex;

    protected $elasticsearchUrl;

    public function setEntityManager(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function getRepository($entity = null)
    {
        if($entity === null) {
            return $this->em->getRepository($this->getEntityName());
        }
        return $this->em->getRepository($entity);
    }

    public function setElasticSearch($enabled, $index, $url)
    {
        $this->elasticsearchEnabled = $enabled;
        $this->elasticsearchIndex = $index;
        $this->elasticsearchUrl = $url;
    }
}
