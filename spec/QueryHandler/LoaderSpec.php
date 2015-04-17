<?php

namespace spec\Indigo\Crud\Doctrine\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Indigo\Hydra\Hydrator;
use Indigo\Crud\Stub\Entity;
use Indigo\Crud\Query\Load;
use PhpSpec\ObjectBehavior;

class LoaderSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $em, Hydrator $hydra)
    {
        $this->beConstructedWith($em, $hydra);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\QueryHandler\Loader');
    }

    function it_handles_a_load_query(Entity $entity, Load $query, EntityRepository $repository, EntityManagerInterface $em, Hydrator $hydra)
    {
        $data = ['data' => 'atad'];

        $query->getEntityClass()->willReturn('Indigo\Crud\Stub\Entity');
        $query->getId()->willReturn(1);

        $repository->find(1)->willReturn($entity);

        $em->getRepository('Indigo\Crud\Stub\Entity')->willReturn($repository);

        $hydra->extract($entity)->willReturn($data);

        $this->handle($query)->shouldReturn($data);
    }

    function it_returns_null_when_no_entity_found(Load $query, EntityRepository $repository, EntityManagerInterface $em)
    {
        $query->getEntityClass()->willReturn('Indigo\Crud\Stub\Entity');
        $query->getId()->willReturn(1);

        $repository->find(1)->willReturn(null);

        $em->getRepository('Indigo\Crud\Stub\Entity')->willReturn($repository);

        $this->handle($query)->shouldReturn(null);
    }
}
