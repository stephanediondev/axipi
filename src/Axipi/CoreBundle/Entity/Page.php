<?php
namespace Axipi\CoreBundle\Entity;

/**
 * Page
 */
class Page
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
    private $metaRobots;

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
     * @var \Axipi\CoreBundle\Entity\Page
     */
    private $parent;

    /**
     * @var \Axipi\CoreBundle\Entity\Component
     */
    private $component;

    /**
     * @var \Axipi\CoreBundle\Entity\Program
     */
    private $program;


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
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * Set metaRobots
     *
     * @param string $metaRobots
     *
     * @return Page
     */
    public function setMetaRobots($metaRobots)
    {
        $this->metaRobots = $metaRobots;

        return $this;
    }

    /**
     * Get metaRobots
     *
     * @return string
     */
    public function getMetaRobots()
    {
        return $this->metaRobots;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * @return Page
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
     * Set parent
     *
     * @param \Axipi\CoreBundle\Entity\Page $parent
     *
     * @return Page
     */
    public function setParent(\Axipi\CoreBundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Axipi\CoreBundle\Entity\Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set component
     *
     * @param \Axipi\CoreBundle\Entity\Component $component
     *
     * @return Page
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
     * Set program
     *
     * @param \Axipi\CoreBundle\Entity\Program $program
     *
     * @return Page
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

    public function setAttribute($key, $value)
    {
        $attributes = $this->getAttributes();
        $attributes[$key] = $value;
        $this->setAttributes(json_encode($attributes));
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
