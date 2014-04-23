<?php

namespace Core\Service;

use Doctrine\Common\Persistence\ObjectManager;

use Core\Repository\UserRepositoryInterface;
use Core\Entity\User;

/**
 * Doctrine User Service Class
 *
 * This is a Doctrine implementation of the UserServiceInterface
 *
 */
class DoctrineUserService implements UserServiceInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Constructor method
     *
     * @param ObjectManager           $objectManager
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(ObjectManager $objectManager, UserRepositoryInterface $userRepository)
    {
        $this->objectManager    = $objectManager;
        $this->userRepository   = $userRepository;
    }

    /**
     * Find all users
     *
     * @return array
     */
    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    /**
     * Find user by ID
     *
     * @param int $id
     * @return User
     */
    public function find($id)
    {
        return $this->userRepository->find($id);
    }

    /**
     * Create user
     *
     * @param User $user
     * @return void
     */
    public function create($user)
    {
        if(!$user instanceOf User) {
            return null;
        }

        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }
}
