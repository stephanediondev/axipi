<?php

namespace Axipi\CoreBundle\Entity;

/**
 * WidgetPage
 */
class WidgetPage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $isActive = false;

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
     * @var \Axipi\CoreBundle\Entity\Page
     */
    private $page;

    /**
     * @var \Axipi\CoreBundle\Entity\Widget
     */
    private $widget;

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
     * Set title
     *
     * @param string $title
     *
     * @return WidgetPage
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return WidgetPage
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
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return WidgetPage
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
     * @return WidgetPage
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
     * @return WidgetPage
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
     * Set page
     *
     * @param \Axipi\CoreBundle\Entity\Page $page
     *
     * @return WidgetPage
     */
    public function setPage(\Axipi\CoreBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Axipi\CoreBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set widget
     *
     * @param \Axipi\CoreBundle\Entity\Widget $widget
     *
     * @return WidgetPage
     */
    public function setWidget(\Axipi\CoreBundle\Entity\Widget $widget = null)
    {
        $this->widget = $widget;

        return $this;
    }

    /**
     * Get widget
     *
     * @return \Axipi\CoreBundle\Entity\Widget
     */
    public function getWidget()
    {
        return $this->widget;
    }
}

