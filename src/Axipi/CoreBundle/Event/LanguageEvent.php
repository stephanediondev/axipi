<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Language;
use Symfony\Component\EventDispatcher\Event;

class LanguageEvent extends Event
{
    protected $data;

    protected $mode;

    public function __construct(Language $data, $mode)
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
