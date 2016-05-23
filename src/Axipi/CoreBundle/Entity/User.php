<?php
namespace Axipi\CoreBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class User implements AdvancedUserInterface, \Serializable
{
    private $id;

    private $username;

    private $password;

    private $firstname;

    private $lastname;

    private $isAuthorized = false;

    private $roles;

    private $dateCreated;

    private $dateModified;

    private $passwordPlain;

    public function getId()
    {
        return $this->id;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setIsAuthorized($isAuthorized)
    {
        $this->isAuthorized = $isAuthorized;

        return $this;
    }

    public function getIsAuthorized()
    {
        return $this->isAuthorized;
    }

    public function setRoles($roles)
    {
        $this->roles = json_encode($roles);

        return $this;
    }

    public function getRoles()
    {
        return json_decode($this->roles);
    }

    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getDateModified()
    {
        return $this->dateModified;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->firstname,
            $this->lastname,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->firstname,
            $this->lastname,
        ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isAuthorized;
    }

    public function setPasswordPlain($passwordPlain)
    {
        $this->passwordPlain = $passwordPlain;

        return $this;
    }

    public function getPasswordPlain()
    {
        return $this->passwordPlain;
    }
}
