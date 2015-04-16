<?php

namespace spec\Indigo\Crud\Doctrine\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Indigo\Crud\Command\SaveEntity;
use Indigo\Crud\Stub\Entity;
use PhpSpec\ObjectBehavior;

class EntitySaverSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $em)
    {
        $this->beConstructedWith($em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\CommandHandler\EntitySaver');
    }

    function it_handles_an_update_command(Entity $entity, SaveEntity $command, EntityManagerInterface $em)
    {
        $command->getEntity()->willReturn($entity);

        $em->flush()->shouldBeCalled();

        $this->handle($command);
    }
}
