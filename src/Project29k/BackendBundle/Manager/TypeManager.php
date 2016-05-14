<?php
namespace Project29k\BackendBundle\Manager;

use Project29k\CoreBundle\Entity\Type;
use Project29k\CoreBundle\Manager\AbstractManager;

class TypeManager extends AbstractManager
{
    public function getEntityName()
    {
        return Type::class;
    }
}
