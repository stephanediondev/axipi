<?php

namespace Axipi\CoreBundle\Entity;

/**
 * RolePermission
 */
class RolePermission
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateModified;

    /**
     * @var \Axipi\CoreBundle\Entity\Role
     */
    private $role;

    /**
     * @var \Axipi\CoreBundle\Entity\Permission
     */
    private $permission;


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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return RolePermission
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
     * @return RolePermission
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
     * Set role
     *
     * @param \Axipi\CoreBundle\Entity\Role $role
     *
     * @return RolePermission
     */
    public function setRole(\Axipi\CoreBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Axipi\CoreBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set permission
     *
     * @param \Axipi\CoreBundle\Entity\Permission $permission
     *
     * @return RolePermission
     */
    public function setPermission(\Axipi\CoreBundle\Entity\Permission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return \Axipi\CoreBundle\Entity\Permission
     */
    public function getPermission()
    {
        return $this->permission;
    }
}

