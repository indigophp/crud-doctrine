<?php

namespace spec\Indigo\Crud\Doctrine\CommandHandler;

use Doctrine\Instantiator\InstantiatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Indigo\Hydra\Hydrator;
use Indigo\Crud\Command\Create;
use Indigo\Crud\Stub\Entity;
use PhpSpec\ObjectBehavior;

class CreatorSpec extends ObjectBehavior
{
    function let(InstantiatorInterface $instantiator, Hydrator $hydra, EntityManagerInterface $em)
    {
        $this->beConstructedWith($instantiator, $hydra, $em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\CommandHandler\Creator');
    }

    function it_handles_a_create_command(Entity $entity, Create $command, InstantiatorInterface $instantiator, Hydrator $hydra, EntityManagerInterface $em)
    {
        $entityClass = 'Indigo\Crud\Stub\Entity';
        $data = [
            'estimatedEnd' => 'now',
        ];

        $command->getEntityClass()->willReturn($entityClass);
        $command->getData()->willReturn($data);

        $instantiator->instantiate($entityClass)->willReturn($entity);

        $hydra->extract($entity)->willReturn([]);
        $hydra->hydrate($entity, $data)->shouldBeCalled();

        $em->persist($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $this->handle($command);
    }
}
