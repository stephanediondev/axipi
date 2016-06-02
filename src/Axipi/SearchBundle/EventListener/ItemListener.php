<?php
namespace Axipi\SearchBundle\EventListener;

use Axipi\SearchBundle\Manager\SearchManager;
use Axipi\CoreBundle\Event\ItemEvent;

class ItemListener
{
    protected $searchManager;

    public function __construct(
        SearchManager $searchManager
    ) {
        $this->searchManager = $searchManager;
    }

    public function persist(ItemEvent $itemEvent)
    {
        $this->searchManager->persist($itemEvent->getItem());
    }

    public function remove(ItemEvent $itemEvent)
    {
        $this->searchManager->remove($itemEvent->getItem());
    }
}
