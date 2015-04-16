<?php

namespace spec\Indigo\Crud\Doctrine\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Indigo\Crud\Query\FindEntity;
use PhpSpec\ObjectBehavior;

class EntityFinderSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $em)
    {
        $this->beConstructedWith($em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\QueryHandler\EntityFinder');
    }

    function it_handles_a_find_query(FindEntity $query, EntityRepository $repository, EntityManagerInterface $em)
    {
        $query->getEntityClass()->willReturn('Indigo\Crud\Stub\Entity');
        $query->getId()->willReturn(1);

        $repository->find(1)->shouldBeCalled();

        $em->getRepository('Indigo\Crud\Stub\Entity')->willReturn($repository);

        $this->handle($query);
    }
}
