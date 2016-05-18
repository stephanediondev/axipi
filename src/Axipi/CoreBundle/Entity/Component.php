<?php

namespace Axipi\CoreBundle\Entity;

/**
 * Component
 */
class Component
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $zoneId;

    /**
     * @var string
     */
    private $controllerAlias;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $parent;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var boolean
     */
    protected $isUnique = false;

    /**
     * @var boolean
     */
    private $isSearch = false;

    /**
     * @var boolean
     */
    private $isSitemap = false;

    /**
     * @var boolean
     */
    private $isActive = false;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
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
     * Set zoneId
     *
     * @param integer $zoneId
     *
     * @return Component
     */
    public function setZoneId($zoneId)
    {
        $this->zoneId = $zoneId;

        return $this;
    }

    /**
     * Get zoneId
     *
     * @return integer
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * Set controllerAlias
     *
     * @param string $controllerAlias
     *
     * @return Component
     */
    public function setControllerAlias($controllerAlias)
    {
        $this->controllerAlias = $controllerAlias;

        return $this;
    }

    /**
     * Get controllerAlias
     *
     * @return string
     */
    public function getControllerAlias()
    {
        return $this->controllerAlias;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Component
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
     * Set parent
     *
     * @param integer $parent
     *
     * @return Component
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Component
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
     * Set isUnique
     *
     * @param boolean $isUnique
     *
     * @return Component
     */
    public function setIsUnique($isUnique)
    {
        $this->isUnique = $isUnique;

        return $this;
    }

    /**
     * Get isUnique
     *
     * @return boolean
     */
    public function getIsUnique()
    {
        return $this->isUnique;
    }

    /**
     * Set isSearch
     *
     * @param boolean $isSearch
     *
     * @return Component
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
     * Set isSitemap
     *
     * @param boolean $isSitemap
     *
     * @return Component
     */
    public function setIsSitemap($isSitemap)
    {
        $this->isSitemap = $isSitemap;

        return $this;
    }

    /**
     * Get isSitemap
     *
     * @return boolean
     */
    public function getIsSitemap()
    {
        return $this->isSitemap;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Component
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
     * @return Component
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
     * @return Component
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

