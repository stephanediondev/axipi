<?php
namespace Axipi\BackendBundle\Manager;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\User;

class UserManager extends AbstractManager
{
    protected $passwordEncoder;

    public function __construct(EncoderFactory $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getById($id)
    {
        return $this->em->getRepository('AxipiCoreBundle:User')->getById($id);
    }

    public function getRows()
    {
        return $this->em->getRepository('AxipiCoreBundle:User')->getRows();
    }

    public function getRoles()
    {
        $roles = [];
        $roles[] = 'ROLE_PAGES';
        $roles[] = 'ROLE_WIDGETS';
        $roles[] = 'ROLE_MEDIAS';
        $roles[] = 'ROLE_LANGUAGES';
        $roles[] = 'ROLE_COMPONENTS';
        $roles[] = 'ROLE_ZONES';
        $roles[] = 'ROLE_USERS';
        return $roles;
    }

    public function persist($data)
    {
        if($data->getPasswordChange()) {
            $encoder = $this->passwordEncoder->getEncoder($data);
            $encodedPassword = $encoder->encodePassword($data->getPasswordChange(), $data->getSalt());
            $data->setPassword($encodedPassword);
            $data->setPasswordChange(null);
        }

        if($data->getRolesChange()) {
            $old_roles = $data->getRoles();
            $change_roles = $data->getRolesChange();
            $new_roles = [];
            foreach($change_roles as $role) {
                $new_roles[] = $role;
            }
            if(is_array($old_roles) && in_array('ROLE_USERS', $old_roles)) {
                $new_roles[] = 'ROLE_USERS';
            }
            $new_roles = array_unique($new_roles);
            $data->setRoles($new_roles);
            $data->setRolesChange(null);
        }

        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($type)
    {
        $this->em->remove($type);
        $this->em->flush();
    }
}
