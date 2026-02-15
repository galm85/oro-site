<?php

namespace Gwd\Bundle\ResellerBundle\Layout\DataProvider;

use Doctrine\ORM\EntityManagerInterface;
use Gwd\Bundle\ResellerBundle\Entity\ResellerType;

class ResellersProvider
{

    public function __construct(private EntityManagerInterface $entityManager)
    {

    }

    public function getResellers():array
    {
        return $this->entityManager
            ->getRepository(ResellerType::class)
            ->findBy(['status'=>'active'],['name'=>'ASC']);
    }
}