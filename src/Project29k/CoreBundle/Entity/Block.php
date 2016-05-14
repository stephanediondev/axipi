<?php

namespace Project29k\CoreBundle\Entity;

/**
 * Block
 */
class Block
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var integer
     */
    private $ordering = '0';

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CoreBundle\Entity\Type
     */
    private $type;


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Block
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Block
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return Block
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return Block
     */
    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Get datecreated
     *
     * @return \DateTime
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

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
     * Set type
     *
     * @param \CoreBundle\Entity\Type $type
     *
     * @return Block
     */
    public function setType(\CoreBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \CoreBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }
}
