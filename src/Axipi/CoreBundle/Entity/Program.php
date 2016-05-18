<?php

namespace Axipi\CoreBundle\Entity;

/**
 * Program
 */
class Program
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $descriptionSeo;

    /**
     * @var string
     */
    private $timezone;

    /**
     * @var boolean
     */
    private $isDefault = '0';

    /**
     * @var boolean
     */
    private $hasMaintenance = '0';

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateModified;

    /**
     * @var \Axipi\CoreBundle\Entity\Country
     */
    private $country;

    /**
     * @var \Axipi\CoreBundle\Entity\Language
     */
    private $language;


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
     * Set descriptionSeo
     *
     * @param string $descriptionSeo
     *
     * @return Program
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
     * Set isDefault
     *
     * @param boolean $isDefault
     *
     * @return Program
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set hasMaintenance
     *
     * @param boolean $hasMaintenance
     *
     * @return Program
     */
    public function setHasMaintenance($hasMaintenance)
    {
        $this->hasMaintenance = $hasMaintenance;

        return $this;
    }

    /**
     * Get hasMaintenance
     *
     * @return boolean
     */
    public function getHasMaintenance()
    {
        return $this->hasMaintenance;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Program
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
     * @return Program
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
     * Set country
     *
     * @param \Axipi\CoreBundle\Entity\Country $country
     *
     * @return Program
     */
    public function setCountry(\Axipi\CoreBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Axipi\CoreBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set language
     *
     * @param \Axipi\CoreBundle\Entity\Language $language
     *
     * @return Program
     */
    public function setLanguage(\Axipi\CoreBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Axipi\CoreBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
}

