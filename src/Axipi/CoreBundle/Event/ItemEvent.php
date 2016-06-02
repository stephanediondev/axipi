<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Item;
use Symfony\Component\EventDispatcher\Event;

class ItemEvent extends Event
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getItem()
    {
        return $this->item;
    }
}
