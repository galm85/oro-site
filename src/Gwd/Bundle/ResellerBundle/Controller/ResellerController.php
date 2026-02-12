<?php

namespace Gwd\Bundle\ResellerBundle\Controller;

use Gwd\Bundle\ResellerBundle\Entity\ResellerType;
use Gwd\Bundle\ResellerBundle\Form\Type\ResellerFormType;
use Oro\Bundle\FormBundle\Model\UpdateHandlerFacade;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Reseller Controller
 */
#[Route(path: '/reseller')]
class ResellerController extends AbstractController
{
    public function __construct(
        private UpdateHandlerFacade $updateHandlerFacade,
        private TranslatorInterface $translator
    ) {
    }

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

    #[Route('/create', name: 'gwd_reseller_create')]
    #[Template('@Reseller/Reseller/update.html.twig')]
    #[Acl(id: 'gwd_reseller_create', type: 'entity', class: ResellerType::class, permission: 'CREATE')]
    public function createAction(Request $request): array|RedirectResponse
    {
        return $this->update(new ResellerType(), $request);
    }

    #[Route('/update/{id}', name: 'gwd_reseller_update', requirements: ['id' => '\d+'])]
    #[Template('@Reseller/Reseller/update.html.twig')]
    #[Acl(id: 'gwd_reseller_update', type: 'entity', class: ResellerType::class, permission: 'EDIT')]
    public function updateAction(ResellerType $reseller, Request $request): array|RedirectResponse
    {
        return $this->update($reseller, $request);
    }

    protected function update(ResellerType $reseller, Request $request): array|RedirectResponse
    {
        // Set dates if creating new entity
        if (!$reseller->getId()) {
            $reseller->setCreatedAt(new \DateTime('now', new \DateTimeZone('UTC')));
        }
        $reseller->setUpdatedAt(new \DateTime('now', new \DateTimeZone('UTC')));

        return $this->updateHandlerFacade->update(
            $reseller,
            $this->createForm(ResellerFormType::class, $reseller),
            $this->translator->trans('Reseller saved successfully'),
            $request
        );
    }
}