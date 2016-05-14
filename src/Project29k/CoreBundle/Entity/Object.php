<?php

namespace Project29k\CoreBundle\Entity;

/**
 * Object
 */
class Object
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $titleSeo;

    /**
     * @var string
     */
    private $descriptionSeo;

    /**
     * @var string
     */
    private $robots;

    /**
     * @var boolean
     */
    private $active = '0';

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
     * @var \CoreBundle\Entity\Program
     */
    private $program;

    /**
     * @var \CoreBundle\Entity\Type
     */
    private $type;

    /**
     * @var \CoreBundle\Entity\Object
     */
    private $parent;

    /**
     * @var \CoreBundle\Entity\Zone
     */
    private $zone;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Object
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
     * @return Object
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Object
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set titleSeo
     *
     * @param string $titleSeo
     *
     * @return Object
     */
    public function setTitleSeo($titleSeo)
    {
        $this->titleSeo = $titleSeo;

        return $this;
    }

    /**
     * Get titleSeo
     *
     * @return string
     */
    public function getTitleSeo()
    {
        return $this->titleSeo;
    }

    /**
     * Set descriptionSeo
     *
     * @param string $descriptionSeo
     *
     * @return Object
     */
    public function setDescriptionSeo($descriptionSeo)
    {
        $this->descriptionSeo = $descriptionSeo;

        return $this;
    }

    /**
     * Get descriptionSeo
     *
     * @return string
     */
    public function getDescriptionSeo()
    {
        return $this->descriptionSeo;
    }

    /**
     * Set robots
     *
     * @param string $robots
     *
     * @return Object
     */
    public function setRobots($robots)
    {
        $this->robots = $robots;

        return $this;
    }

    /**
     * Get robots
     *
     * @return string
     */
    public function getRobots()
    {
        return $this->robots;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Object
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
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return Object
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
     * @return Object
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
     * Set program
     *
     * @param \CoreBundle\Entity\Program $program
     *
     * @return Object
     */
    public function setProgram(\CoreBundle\Entity\Program $program = null)
    {
        $this->program = $program;

        return $this;
    }

    /**
     * Get program
     *
     * @return \CoreBundle\Entity\Program
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set type
     *
     * @param \CoreBundle\Entity\Type $type
     *
     * @return Object
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

    /**
     * Set parent
     *
     * @param \CoreBundle\Entity\Object $parent
     *
     * @return Object
     */
    public function setParent(\CoreBundle\Entity\Object $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \CoreBundle\Entity\Object
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set zone
     *
     * @param \CoreBundle\Entity\Zone $zone
     *
     * @return Object
     */
    public function setZone(\CoreBundle\Entity\Zone $zone = null)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \CoreBundle\Entity\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }
}
