<?php

namespace Axipi\CoreBundle\Manager;

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

    public function getRepository($entity)
    {
        return $this->em->getRepository($entity);
    }
}
