<?php

namespace spec\Indigo\Crud\Doctrine\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Indigo\Crud\Command\DeleteEntity;
use Indigo\Crud\Stub\Entity;
use PhpSpec\ObjectBehavior;

class EntityRemoverSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $em)
    {
        $this->beConstructedWith($em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\CommandHandler\EntityRemover');
    }

    function it_handles_a_delete_command(Entity $entity, DeleteEntity $command, EntityManagerInterface $em)
    {
        $command->getEntity()->willReturn($entity);

        $em->remove($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->handle($command);
    }
}
