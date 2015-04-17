<?php

namespace spec\Indigo\Crud\Doctrine\CommandHandler;

use Doctrine\ORM\EntityManagerInterface;
use Indigo\Hydra\Hydrator;
use Indigo\Crud\Command\Update;
use Indigo\Crud\Stub\Entity;
use PhpSpec\ObjectBehavior;

class UpdaterSpec extends ObjectBehavior
{
    function let(Hydrator $hydra, EntityManagerInterface $em)
    {
        $this->beConstructedWith($hydra, $em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\CommandHandler\Updater');
    }

    function it_handles_an_update_command(Entity $entity, Update $command, Hydrator $hydra, EntityManagerInterface $em)
    {
        $data = ['data' => 'atad'];

        $command->getEntity()->willReturn($entity);
        $command->getData()->willReturn($data);

        $hydra->hydrate($entity, $data)->shouldBeCalled();
        $hydra->extract($entity)->willReturn([]);

        $em->flush()->shouldBeCalled();

        $this->handle($command);
    }
}
