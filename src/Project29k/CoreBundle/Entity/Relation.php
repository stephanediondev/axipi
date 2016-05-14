<?php

namespace CoreBundle\Entity;

/**
 * Relation
 */
class Relation
{
    /**
     * @var integer
     */
    private $objId;

    /**
     * @var integer
     */
    private $relTarget;

    /**
     * @var string
     */
    private $relTitle;

    /**
     * @var boolean
     */
    private $relActive = '0';

    /**
     * @var integer
     */
    private $relOrdering = '0';

    /**
     * @var \DateTime
     */
    private $relDatecreated;

    /**
     * @var integer
     */
    private $relId;


    /**
     * Set objId
     *
     * @param integer $objId
     *
     * @return Relation
     */
    public function setObjId($objId)
    {
        $this->objId = $objId;

        return $this;
    }

    /**
     * Get objId
     *
     * @return integer
     */
    public function getObjId()
    {
        return $this->objId;
    }

    /**
     * Set relTarget
     *
     * @param integer $relTarget
     *
     * @return Relation
     */
    public function setRelTarget($relTarget)
    {
        $this->relTarget = $relTarget;

        return $this;
    }

    /**
     * Get relTarget
     *
     * @return integer
     */
    public function getRelTarget()
    {
        return $this->relTarget;
    }

    /**
     * Set relTitle
     *
     * @param string $relTitle
     *
     * @return Relation
     */
    public function setRelTitle($relTitle)
    {
        $this->relTitle = $relTitle;

        return $this;
    }

    /**
     * Get relTitle
     *
     * @return string
     */
    public function getRelTitle()
    {
        return $this->relTitle;
    }

    /**
     * Set relActive
     *
     * @param boolean $relActive
     *
     * @return Relation
     */
    public function setRelActive($relActive)
    {
        $this->relActive = $relActive;

        return $this;
    }

    /**
     * Get relActive
     *
     * @return boolean
     */
    public function getRelActive()
    {
        return $this->relActive;
    }

    /**
     * Set relOrdering
     *
     * @param integer $relOrdering
     *
     * @return Relation
     */
    public function setRelOrdering($relOrdering)
    {
        $this->relOrdering = $relOrdering;

        return $this;
    }

    /**
     * Get relOrdering
     *
     * @return integer
     */
    public function getRelOrdering()
    {
        return $this->relOrdering;
    }

    /**
     * Set relDatecreated
     *
     * @param \DateTime $relDatecreated
     *
     * @return Relation
     */
    public function setRelDatecreated($relDatecreated)
    {
        $this->relDatecreated = $relDatecreated;

        return $this;
    }

    /**
     * Get relDatecreated
     *
     * @return \DateTime
     */
    public function getRelDatecreated()
    {
        return $this->relDatecreated;
    }

    /**
     * Get relId
     *
     * @return integer
     */
    public function getRelId()
    {
        return $this->relId;
    }
}
