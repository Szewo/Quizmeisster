<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->entityManager = $entityManager;
    }

    /**
     * Function returns encoded user password
     * @param User $user
     * @return string
     */
    public function UserPasswordEncoder(User $user): string
    {
       return $this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword());
    }

    public function PersistUser(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}