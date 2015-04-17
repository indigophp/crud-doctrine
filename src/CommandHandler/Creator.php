<?php

/*
 * This file is part of the Indigo CRUD package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Crud\Doctrine\CommandHandler;

use Doctrine\Instantiator\InstantiatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Indigo\Hydra\Hydrator;
use Indigo\Crud\Command\Create;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Creator
{
    /**
     * @var InstantiatorInterface
     */
    protected $instantiator;

    /**
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param InstantiatorInterface  $instantiator
     * @param Hydrator               $hydrator
     * @param EntityManagerInterface $em
     */
    public function __construct(InstantiatorInterface $instantiator, Hydrator $hydrator, EntityManagerInterface $em)
    {
        $this->instantiator = $instantiator;
        $this->hydrator = $hydrator;
        $this->em = $em;
    }

    /**
     * Creates a new entity
     *
     * @param Create $command
     */
    public function handle(Create $command)
    {
        $entityClass = $command->getEntityClass();
        $entity = $this->instantiator->instantiate($entityClass);
        $data = $command->getData();

        // UGLY WORKAROUND BEGINS
        $data = array_merge($this->hydrator->extract($entity), $data);
        // UGLY WORKAROUND ENDS

        $this->hydrator->hydrate($entity, $data);

        $this->em->persist($entity);
        $this->em->flush();
    }
}
