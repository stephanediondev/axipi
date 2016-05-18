<?php

namespace Axipi\CoreBundle\Entity;

/**
 * Attribute
 */
class Attribute
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var boolean
     */
    private $isRequired = '0';

    /**
     * @var boolean
     */
    private $isUpload = '0';

    /**
     * @var boolean
     */
    private $isRich = '0';

    /**
     * @var boolean
     */
    private $isSearch = '0';

    /**
     * @var integer
     */
    private $ordering = '0';

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateModified;

    /**
     * @var \Axipi\CoreBundle\Entity\Block
     */
    private $block;


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
     * Set isRequired
     *
     * @param boolean $isRequired
     *
     * @return Attribute
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * Get isRequired
     *
     * @return boolean
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }

    /**
     * Set isUpload
     *
     * @param boolean $isUpload
     *
     * @return Attribute
     */
    public function setIsUpload($isUpload)
    {
        $this->isUpload = $isUpload;

        return $this;
    }

    /**
     * Get isUpload
     *
     * @return boolean
     */
    public function getIsUpload()
    {
        return $this->isUpload;
    }

    /**
     * Set isRich
     *
     * @param boolean $isRich
     *
     * @return Attribute
     */
    public function setIsRich($isRich)
    {
        $this->isRich = $isRich;

        return $this;
    }

    /**
     * Get isRich
     *
     * @return boolean
     */
    public function getIsRich()
    {
        return $this->isRich;
    }

    /**
     * Set isSearch
     *
     * @param boolean $isSearch
     *
     * @return Attribute
     */
    public function setIsSearch($isSearch)
    {
        $this->isSearch = $isSearch;

        return $this;
    }

    /**
     * Get isSearch
     *
     * @return boolean
     */
    public function getIsSearch()
    {
        return $this->isSearch;
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Attribute
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
     * @return Attribute
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

    /**
     * Set block
     *
     * @param \Axipi\CoreBundle\Entity\Block $block
     *
     * @return Attribute
     */
    public function setBlock(\Axipi\CoreBundle\Entity\Block $block = null)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return \Axipi\CoreBundle\Entity\Block
     */
    public function getBlock()
    {
        return $this->block;
    }
}

