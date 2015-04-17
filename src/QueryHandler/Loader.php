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
use Indigo\Hydra\Hydrator;
use Indigo\Crud\Query\Load;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Loader
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * @param EntityManagerInterface $em
     * @param Hydrator               $hydrator
     */
    public function __construct(EntityManagerInterface $em, Hydrator $hydrator)
    {
        $this->em = $em;
        $this->hydrator = $hydrator;
    }

    /**
     * Returns an entity's data
     *
     * @param Load $query
     *
     * @return array|null
     */
    public function handle(Load $query)
    {
        $entityClass = $query->getEntityClass();
        $id = $query->getId();

        $entity = $this->em->getRepository($entityClass)->find($id);

        if ($entity) {
            return $this->hydrator->extract($entity);
        }
    }
}
