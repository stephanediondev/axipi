<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Relation;
use Symfony\Component\EventDispatcher\Event;

class RelationEvent extends Event
{
    protected $relation;

    public function __construct(Relation $relation)
    {
        $this->relation = $relation;
    }

    public function getRelation()
    {
        return $this->relation;
    }
}
