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
use Indigo\Crud\Query\FindAllEntities;

/**
 * Handles all entities fetching
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class AllEntityFinder
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
     * @param FindAllEntities $query
     *
     * @return object|null
     */
    public function handle(FindAllEntities $query)
    {
        $entityClass = $query->getEntityClass();

        return $this->em->getRepository($entityClass)->findAll();
    }
}