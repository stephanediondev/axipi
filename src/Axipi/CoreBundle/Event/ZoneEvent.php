<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Zone;
use Symfony\Component\EventDispatcher\Event;

class ZoneEvent extends Event
{
    protected $data;

    protected $mode;

    public function __construct(Zone $data, $mode)
    {
        $this->data = $data;
        $this->mode = $mode;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMode()
    {
        return $this->mode;
    }
}
