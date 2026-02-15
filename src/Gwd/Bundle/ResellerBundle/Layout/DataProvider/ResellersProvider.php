<?php

namespace Gwd\Bundle\ResellerBundle\Layout\DataProvider;

use Doctrine\ORM\EntityManagerInterface;
use Gwd\Bundle\ResellerBundle\Entity\ResellerType;
use Symfony\Component\HttpFoundation\RequestStack;

class ResellersProvider
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private RequestStack $requestStack
    )
    {

    }

    public function getResellers():array
    {
        $request = $this->requestStack->getCurrentRequest();
        $searchTerm = $request ? $request->query->get('search','') : '';

        $qb = $this->entityManager
            ->getRepository(ResellerType::class)
            ->createQueryBuilder('r')
            ->where('r.status = :status')
            ->setParameter('status','active');

        if($searchTerm){
            $qb->andWhere('LOWER(r.name) LIKE LOWER(:search)')
                ->setParameter('search','%'.$searchTerm.'%');
        }

        $qb->orderBy('r.name','ASC');

        return $qb->getQuery()->getResult();

    }
}