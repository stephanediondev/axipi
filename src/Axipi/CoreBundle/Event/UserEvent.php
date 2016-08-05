<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    protected $data;

    protected $mode;

    public function __construct(User $data, $mode)
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
