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

use Doctrine\ORM\EntityManagerInterface;
use Indigo\Hydra\Hydrator;
use Indigo\Crud\Command\Update;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Updater
{
    /**
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @param Hydrator               $hydrator
     * @param EntityManagerInterface $em
     */
    public function __construct(Hydrator $hydrator, EntityManagerInterface $em)
    {
        $this->hydrator = $hydrator;
        $this->em = $em;
    }

    /**
     * Updates an entity
     *
     * @param Update $command
     */
    public function handle(Update $command)
    {
        $entity = $command->getEntity();
        $data = $command->getData();

        // UGLY WORKAROUND BEGINS
        $data = array_merge($this->hydrator->extract($entity), $data);
        // UGLY WORKAROUND ENDS

        $this->hydrator->hydrate($entity, $data);

        $this->em->flush();
    }
}
