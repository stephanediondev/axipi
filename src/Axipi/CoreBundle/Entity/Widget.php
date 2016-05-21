<?php

namespace Axipi\CoreBundle\Entity;

/**
 * Widget
 */
class Widget
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
     * @var string
     */
    private $code;

    /**
     * @var boolean
     */
    private $isActive = false;

    /**
     * @var integer
     */
    private $ordering = '0';

    /**
     * @var string
     */
    private $attributes;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateModified;

    /**
     * @var \Axipi\CoreBundle\Entity\Program
     */
    private $program;

    /**
     * @var \Axipi\CoreBundle\Entity\Component
     */
    private $component;

    /**
     * @var \Axipi\CoreBundle\Entity\Zone
     */
    private $zone;


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
     * @return Widget
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
     * Set code
     *
     * @param string $code
     *
     * @return Widget
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Widget
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
     * @return Widget
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
     * Set attributes
     *
     * @param string $attributes
     *
     * @return Page
     */
    public function setAttributes($attributes)
    {
        $this->attributes = json_encode($attributes);

        return $this;
    }

    /**
     * Get attributes
     *
     * @return string
     */
    public function getAttributes()
    {
        if(is_string($this->attributes)) {
            return $this->attributes = json_decode($this->attributes, true);
        } else {
            return $this->attributes;
        }
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Widget
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
     * @return Widget
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
     * Set program
     *
     * @param \Axipi\CoreBundle\Entity\Program $program
     *
     * @return Widget
     */
    public function setProgram(\Axipi\CoreBundle\Entity\Program $program = null)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * Get program
     *
     * @return \Axipi\CoreBundle\Entity\Program
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set component
     *
     * @param \Axipi\CoreBundle\Entity\Component $component
     *
     * @return Widget
     */
    public function setComponent(\Axipi\CoreBundle\Entity\Component $component = null)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return \Axipi\CoreBundle\Entity\Component
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Set zone
     *
     * @param \Axipi\CoreBundle\Entity\Zone $zone
     *
     * @return Widget
     */
    public function setZone(\Axipi\CoreBundle\Entity\Zone $zone = null)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \Axipi\CoreBundle\Entity\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        $attributes = $this->getAttributes();
        if(isset($attributes[$key]) == 1) {
            return $attributes[$key];
        } else {
            return false;
        }
    }
}
