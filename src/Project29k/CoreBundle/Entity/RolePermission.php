<?php

namespace Project29k\CoreBundle\Entity;

/**
 * RolePermission
 */
class RolePermission
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
     * @var \CoreBundle\Entity\Permission
     */
    private $permission;

    /**
     * @var \CoreBundle\Entity\Role
     */
    private $role;


    /**
     * Set datecreated
     *
     * @param \DateTime $datecreated
     *
     * @return RolePermission
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
     * Set permission
     *
     * @param \CoreBundle\Entity\Permission $permission
     *
     * @return RolePermission
     */
    public function setPermission(\CoreBundle\Entity\Permission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return \CoreBundle\Entity\Permission
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set role
     *
     * @param \CoreBundle\Entity\Role $role
     *
     * @return RolePermission
     */
    public function setRole(\CoreBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \CoreBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}
