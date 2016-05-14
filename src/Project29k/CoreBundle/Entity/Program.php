<?php

namespace Project29k\CoreBundle\Entity;

/**
 * Program
 */
class Program
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $timezone;

    /**
     * @var boolean
     */
    private $default = '0';

    /**
     * @var boolean
     */
    private $maintenance = '0';

    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CoreBundle\Entity\Language
     */
    private $language;

    /**
     * @var \CoreBundle\Entity\Country
     */
    private $country;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Program
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
     * Set description
     *
     * @param string $description
     *
     * @return Program
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return Program
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set default
     *
     * @param boolean $default
     *
     * @return Program
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set maintenance
     *
     * @param boolean $maintenance
     *
     * @return Program
     */
    public function setMaintenance($maintenance)
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    /**
     * Get maintenance
     *
     * @return boolean
     */
    public function getMaintenance()
    {
        return $this->maintenance;
    }

    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return Program
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
     * Set language
     *
     * @param \CoreBundle\Entity\Language $language
     *
     * @return Program
     */
    public function setLanguage(\CoreBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \CoreBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set country
     *
     * @param \CoreBundle\Entity\Country $country
     *
     * @return Program
     */
    public function setCountry(\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }
}
