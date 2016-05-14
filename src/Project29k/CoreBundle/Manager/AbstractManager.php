<?php

namespace Project29k\CoreBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractManager
{
    protected $em;

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
}
