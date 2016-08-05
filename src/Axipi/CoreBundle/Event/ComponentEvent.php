<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Component;
use Symfony\Component\EventDispatcher\Event;

class ComponentEvent extends Event
{
    protected $data;

    protected $mode;

    public function __construct(Component $data, $mode)
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
