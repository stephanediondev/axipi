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

    public function persist(User $user)
    {
        if($user->getPasswordPlain()) {
            $encoder = $this->passwordEncoder->getEncoder($user);
            $encodedPassword = $encoder->encodePassword($user->getPasswordPlain(), $user->getSalt());
            $user->setPassword($encodedPassword);
            $user->setPasswordPlain(null);
        }

        if($user->getDateCreated() == null) {
            $user->setDateCreated(new \Datetime());
        }
        $user->setDateModified(new \Datetime());

        $this->em->persist($user);
        $this->em->flush();
    }

    public function remove($type)
    {
        $this->em->remove($type);
        $this->em->flush();
    }
}
