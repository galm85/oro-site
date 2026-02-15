<?php

namespace Gwd\Bundle\ResellerBundle\Controller\Frontend;

use Doctrine\ORM\EntityManagerInterface;
use Gwd\Bundle\ResellerBundle\Entity\ResellerType;
use Oro\Bundle\LayoutBundle\Attribute\Layout;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResellerController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/resellers', name: 'resellers')]
    #[Layout]
    public function indexAction(Request $request): array
    {
       return [];
    }
}