<?php

namespace Project29k\CoreBundle\Entity;

/**
 * ProgramUser
 */
class ProgramUser
{
    /**
     * @var \DateTime
     */
    private $datecreated;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \CoreBundle\Entity\User
     */
    private $user;

    /**
     * @var \CoreBundle\Entity\Program
     */
    private $program;


    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return ProgramUser
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
     * Set user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return ProgramUser
     */
    public function setUser(\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set program
     *
     * @param \CoreBundle\Entity\Program $program
     *
     * @return ProgramUser
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
}
