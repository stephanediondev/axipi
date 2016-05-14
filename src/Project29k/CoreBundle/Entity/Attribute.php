<?php

namespace Project29k\CoreBundle\Entity;

/**
 * Attribute
 */
class Attribute
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var boolean
     */
    private $upload = '0';

    /**
     * @var boolean
     */
    private $rich = '0';

    /**
     * @var boolean
     */
    private $required = '0';

    /**
     * @var boolean
     */
    private $search = '0';

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
     * @var \CoreBundle\Entity\Block
     */
    private $block;


    /**
     * Set code
     *
     * @param string $code
     *
     * @return Attribute
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
     * Set upload
     *
     * @param boolean $upload
     *
     * @return Attribute
     */
    public function setUpload($upload)
    {
        $this->upload = $upload;

        return $this;
    }

    /**
     * Get upload
     *
     * @return boolean
     */
    public function getUpload()
    {
        return $this->upload;
    }

    /**
     * Set rich
     *
     * @param boolean $rich
     *
     * @return Attribute
     */
    public function setRich($rich)
    {
        $this->rich = $rich;

        return $this;
    }

    /**
     * Get rich
     *
     * @return boolean
     */
    public function getRich()
    {
        return $this->rich;
    }

    /**
     * Set required
     *
     * @param boolean $required
     *
     * @return Attribute
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set search
     *
     * @param boolean $search
     *
     * @return Attribute
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get search
     *
     * @return boolean
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return Attribute
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
     * @return Attribute
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
     * Set block
     *
     * @param \CoreBundle\Entity\Block $block
     *
     * @return Attribute
     */
    public function setBlock(\CoreBundle\Entity\Block $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \CoreBundle\Entity\Block
     */
    public function getBlock()
    {
        return $this->block;
    }
}
