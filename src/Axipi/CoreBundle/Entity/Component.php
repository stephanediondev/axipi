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
    private $zone;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $title;

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
    protected $isHome = false;

    /**
     * @var boolean
     */
    private $excludeSearch = false;

    /**
     * @var boolean
     */
    private $excludeSitemap = false;

    /**
     * @var boolean
     */
    private $isActive = false;

    /**
     * @var string
     */
    private $attributesSchema;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateModified;

    private $children;

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
     * Set zone
     *
     * @param integer $zone
     *
     * @return Component
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return integer
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Category
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set service
     *
     * @param string $service
     *
     * @return Component
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Component
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set isHome
     *
     * @param boolean $isHome
     *
     * @return Component
     */
    public function setIsHome($isHome)
    {
        $this->isHome = $isHome;

        return $this;
    }

    /**
     * Get isHome
     *
     * @return boolean
     */
    public function getIsHome()
    {
        return $this->isHome;
    }

    /**
     * Set excludeSearch
     *
     * @param boolean $excludeSearch
     *
     * @return Component
     */
    public function setExcludeSearch($excludeSearch)
    {
        $this->excludeSearch = $excludeSearch;

        return $this;
    }

    /**
     * Get excludeSearch
     *
     * @return boolean
     */
    public function getExcludeSearch()
    {
        return $this->excludeSearch;
    }

    /**
     * Set excludeSitemap
     *
     * @param boolean $excludeSitemap
     *
     * @return Component
     */
    public function setExcludeSitemap($excludeSitemap)
    {
        $this->excludeSitemap = $excludeSitemap;

        return $this;
    }

    /**
     * Get excludeSitemap
     *
     * @return boolean
     */
    public function getExcludeSitemap()
    {
        return $this->excludeSitemap;
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
     * Set attributesSchema
     *
     * @param string $attributesSchema
     *
     * @return Component
     */
    public function setAttributesSchema($attributesSchema)
    {
        $this->attributesSchema = $attributesSchema;

        return $this;
    }

    /**
     * Get attributesSchema
     *
     * @return string
     */
    public function getAttributesSchema()
    {
        return $this->attributesSchema;
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

    public function getChildren()
    {
        return $this->children;
    }
}
