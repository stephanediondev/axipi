<?php
namespace Axipi\CoreBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Zone
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Axipi\CoreBundle\Entity\Item
     */
    private $item;

    private $author;

    private $email;

    private $website;

    private $message;

    private $isActive = '0';

    private $dateCreated;

    private $dateModified;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set page
     *
     * @param \Axipi\CoreBundle\Entity\Item $page
     *
     * @return Relation
     */
    public function setItem(\Axipi\CoreBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Axipi\CoreBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Zone
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return Zone
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getWebsite()
    {
        return $this->website;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Zone
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Zone
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     *
     * @return Zone
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }
}
