<?php

namespace Core\Repository;

/**
 * Base Repository Interface Class
 */
interface BaseRepositoryInterface
{
    /**
     * Find all results of an entity
     */
    public function findAll();

    /**
     * Find entity by ID
     *
     * @param  int $id
     */
    public function find($id);
}
