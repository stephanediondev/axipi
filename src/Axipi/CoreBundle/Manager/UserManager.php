<?php
namespace Axipi\CoreBundle\Manager;

use Symfony\Component\Security\Core\Encoder\EncoderFactory;

use Axipi\CoreBundle\Manager\AbstractManager;
use Axipi\CoreBundle\Entity\User;
use Axipi\CoreBundle\Event\UserEvent;

class UserManager extends AbstractManager
{
    protected $passwordEncoder;

    public function setPasswordEncoder(EncoderFactory $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function getOne($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:User')->getOne($parameters);
    }

    public function getList($parameters = [])
    {
        return $this->em->getRepository('AxipiCoreBundle:User')->getList($parameters);
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

        $event = new UserEvent($data);
        $this->eventDispatcher->dispatch('user.after_persist', $event);

        return $data->getId();
    }

    public function remove($data)
    {
        $event = new UserEvent($data);
        $this->eventDispatcher->dispatch('user.before_remove', $event);

        $this->em->remove($data);
        $this->em->flush();
    }

    public function getRoles()
    {
        $roles = [];
        $roles[] = 'ROLE_PAGES';
        $roles[] = 'ROLE_WIDGETS';
        $roles[] = 'ROLE_FILES';
        $roles[] = 'ROLE_LANGUAGES';
        $roles[] = 'ROLE_COMPONENTS';
        $roles[] = 'ROLE_ZONES';
        $roles[] = 'ROLE_SEARCH';
        $roles[] = 'ROLE_USERS';
        $roles[] = 'ROLE_INFO';
        return $roles;
    }
}
