<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Zone;
use Symfony\Component\EventDispatcher\Event;

class ZoneEvent extends Event
{
    protected $zone;

    public function __construct(Zone $zone)
    {
        $this->zone = $zone;
    }

    public function getZone()
    {
        return $this->zone;
    }
}
