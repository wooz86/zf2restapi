<?php

namespace Core\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

use Core\Repository\BaseRepositoryInterface;

/**
 * Doctrine Base Repository Class
 *
 * This is a Doctrine implementation of the BaseRepositoryInterface
 */
abstract class DoctrineBaseRepository extends EntityRepository implements BaseRepositoryInterface
{
	/**
	 * Find all results of an entity
	 *
	 * @return Array
	 */
	public function findAll()
	{
	    return parent::findAll();
	}

	/**
	 * Find entity by ID
	 *
	 * @param int $id
	 * @return Channel
	 */
	public function find($id)
	{
	    return $this->findOneBy(array("id" => $id));
	}
}
