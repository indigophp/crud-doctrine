<?php

/*
 * This file is part of the Indigo CRUD package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Crud\Doctrine\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;
use Indigo\Crud\Query\FindEntity;

/**
 * Handles entity searching
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class EntityFinder
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Returns an entity
     *
     * @param FindEntity $query
     *
     * @return object|null
     */
    public function handle(FindEntity $query)
    {
        $entityClass = $query->getEntityClass();
        $id = $query->getId();

        return $this->em->getRepository($entityClass)->find($id);
    }
}
