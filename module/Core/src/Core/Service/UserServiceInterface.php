<?php

namespace Core\Service;

use Core\Repository\UserRepositoryInterface;

/**
 * User Service Interface Class
 */
interface UserServiceInterface extends UserRepositoryInterface
{
    public function create($data);
}
