<?php

namespace Gwd\Bundle\ResellerBundle\Controller;

use Gwd\Bundle\ResellerBundle\Entity\ResellerType;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Reseller Controller
 */
#[Route(path: '/reseller')]
class ResellerController
{

    #[Route('/', name: 'gwd_reseller_index')]
    #[Template]
    #[Acl(id: 'oro_user_user_view', type: 'entity', class: User::class, permission: 'VIEW')]
    public function indexAction(): array
    {
        return [
            'entity_class' => ResellerType::class,
        ];
    }

    #[Route('/view/{id}', name: 'gwd_reseller_view', requirements: ['id' => '\d+'])]
    #[Template]
    public function viewAction(ResellerType $reseller): array
    {
        return [
            'entity' => $reseller,
        ];
    }

}