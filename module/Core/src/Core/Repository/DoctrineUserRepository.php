<?php

namespace Core\Repository;

use Core\Repository\DoctrineBaseRepository;
use Core\Repository\UserRepositoryInterface;

/**
 * Doctrine User Repository Class
 */
class DoctrineUserRepository extends DoctrineBaseRepository implements UserRepositoryInterface
{
    /**
     * Find all users and exclude
     * the password field in the result
     *
     * @return array $response
     */
    public function findAll()
    {
        $result = parent::findAll();

        if(is_array($result)) {
            foreach($result as $k => $v) {
                $tmp = $result[$k]->getArrayCopy();
                unset($tmp['password']);
                $response[] = $tmp;
            }
        }

        return $response;
    }

    /**
     * Find a specific user by ID
     * and exclude the password in the result
     *
     * @param  int $id
     * @return object $result
     */
    public function find($id)
    {
        $result = parent::find($id);

        if(is_object($result)) {
            $result = $result->getArrayCopy();
            unset($result['password']);
        }

        return $result;
    }
}
