<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Component;
use Symfony\Component\EventDispatcher\Event;

class ComponentEvent extends Event
{
    protected $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function getComponent()
    {
        return $this->component;
    }
}
