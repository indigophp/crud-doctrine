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
use Indigo\Crud\Command\Delete;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Remover
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
     * Removes an entity
     *
     * @param Delete $command
     */
    public function handle(Delete $command)
    {
        $entity = $command->getEntity();

        $this->em->remove($entity);
        $this->em->flush();
    }
}
