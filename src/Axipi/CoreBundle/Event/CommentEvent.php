<?php
namespace Axipi\CoreBundle\Event;

use Axipi\CoreBundle\Entity\Comment;
use Symfony\Component\EventDispatcher\Event;

class CommentEvent extends Event
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }
}
