<?php

namespace Project29k\CoreBundle\Entity;

/**
 * Type
 */
class Type
{
    protected $controllerAlias;
    protected $categorie;

    /**
     * @var integer
     */
    private $categorieId;

    /**
     * @var integer
     */
    private $zoneId;

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
    private $unique = false;

    /**
     * @var boolean
     */
    private $search = false;

    /**
     * @var boolean
     */
    private $sitemap = false;

    /**
     * @var boolean
     */
    private $active = false;

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set categorieId
     *
     * @param integer $categorieId
     *
     * @return Type
     */
    public function setCategorieId($categorieId)
    {
        $this->categorieId = $categorieId;

        return $this;
    }

    /**
     * Get categorieId
     *
     * @return integer
     */
    public function getCategorieId()
    {
        return $this->categorieId;
    }

    /**
     * Set zoneId
     *
     * @param integer $zoneId
     *
     * @return Type
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
     * Set code
     *
     * @param string $code
     *
     * @return Type
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
     * @return Type
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
     * @return Type
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
     * Set unique
     *
     * @param boolean $unique
     *
     * @return Type
     */
    public function setUnique($unique)
    {
        $this->unique = $unique;

        return $this;
    }

    /**
     * Get unique
     *
     * @return boolean
     */
    public function getUnique()
    {
        return $this->unique;
    }

    /**
     * Set search
     *
     * @param boolean $search
     *
     * @return Type
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
     * Set sitemap
     *
     * @param boolean $sitemap
     *
     * @return Type
     */
    public function setSitemap($sitemap)
    {
        $this->sitemap = $sitemap;

        return $this;
    }

    /**
     * Get sitemap
     *
     * @return boolean
     */
    public function getSitemap()
    {
        return $this->sitemap;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Type
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return Type
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
     * @var boolean
     */
    private $isUnique = '0';

    /**
     * @var boolean
     */
    private $isSearch = '0';

    /**
     * @var boolean
     */
    private $isSitemap = '0';

    /**
     * @var boolean
     */
    private $isActive = '0';


    /**
     * Set isUnique
     *
     * @param boolean $isUnique
     *
     * @return Type
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
     * @return Type
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
     * @return Type
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
     * @return Type
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
}
