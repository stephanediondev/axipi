<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Comment;
use Symfony\Component\EventDispatcher\Event;

class CommentEvent extends Event
{
    protected $data;

    protected $mode;

    public function __construct(Comment $data, $mode)
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
