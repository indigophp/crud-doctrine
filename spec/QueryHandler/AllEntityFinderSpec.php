<?php

namespace spec\Indigo\Crud\Doctrine\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Indigo\Crud\Query\FindAllEntities;
use PhpSpec\ObjectBehavior;

class AllEntityFinderSpec extends ObjectBehavior
{
    function let(EntityManagerInterface $em)
    {
        $this->beConstructedWith($em);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Crud\Doctrine\QueryHandler\AllEntityFinder');
    }

    function it_handles_a_find_all_query(FindAllEntities $query, EntityRepository $repository, EntityManagerInterface $em)
    {
        $query->getEntityClass()->willReturn('Indigo\Crud\Stub\Entity');

        $repository->findAll()->shouldBeCalled();

        $em->getRepository('Indigo\Crud\Stub\Entity')->willReturn($repository);

        $this->handle($query);
    }
}
