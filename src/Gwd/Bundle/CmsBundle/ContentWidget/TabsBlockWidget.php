<?php

namespace Gwd\Bundle\CmsBundle\ContentWidget;

use Doctrine\Persistence\ManagerRegistry;
use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
use Oro\Bundle\CMSBundle\Entity\ContentBlock;
use Oro\Bundle\CMSBundle\Entity\ContentWidget;
use Oro\Bundle\CMSBundle\Form\Type\ContentBlockSelectType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

class TabsBlockWidget extends AbstractContentWidgetType
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public static function getName(): string
    {
        return 'tabs_block';
    }

    public function getLabel(): string
    {
        return 'Tabs Block';
    }

    public function getDefaultTemplate(ContentWidget $contentWidget, Environment $twig): string
    {
        try {
            return $twig->render(
                '@GwdCms/ContentWidget/tabs_block.html.twig',
                $this->getWidgetData($contentWidget)
            );
        } catch (\Exception $e) {
            return 'Error rendering widget: ' . $e->getMessage();
        }
    }

    public function getSettingsForm(ContentWidget $contentWidget, FormFactoryInterface $formFactory): ?FormInterface
    {
        $form = $formFactory->createBuilder()
            ->add('tab1_title', TextType::class, [
                'label' => 'Tab 1 Title',
                'required' => false
            ])
            ->add('tab1_content_block', ContentBlockSelectType::class, [
                'label' => 'Tab 1 Content Block',
                'required' => false
            ])
            ->add('tab2_title', TextType::class, [
                'label' => 'Tab 2 Title',
                'required' => false
            ])
            ->add('tab2_content_block', ContentBlockSelectType::class, [
                'label' => 'Tab 2 Content Block',
                'required' => false
            ])
            ->add('tab3_title', TextType::class, [
                'label' => 'Tab 3 Title',
                'required' => false
            ])
            ->add('tab3_content_block', ContentBlockSelectType::class, [
                'label' => 'Tab 3 Content Block',
                'required' => false
            ])
            ->add('tab4_title', TextType::class, [
                'label' => 'Tab 4 Title',
                'required' => false
            ])
            ->add('tab4_content_block', ContentBlockSelectType::class, [
                'label' => 'Tab 4 Content Block',
                'required' => false
            ])
            ->getForm();

        $form->setData($contentWidget->getSettings());
        return $form;
    }

    public function getWidgetData(ContentWidget $contentWidget): array
    {
        $settings = $contentWidget->getSettings();
        $tabs = [];

        for ($i = 1; $i <= 4; $i++) {
            $titleKey = "tab{$i}_title";
            $contentBlockKey = "tab{$i}_content_block";

            if (!empty($settings[$titleKey])) {
                $contentBlockId = $settings[$contentBlockKey] ?? null;
                $content = '';

                if ($contentBlockId) {
                    $contentBlock = $this->doctrine
                        ->getRepository(ContentBlock::class)
                        ->find($contentBlockId);

                    if ($contentBlock) {
                        $defaultVariant = $contentBlock->getDefaultVariant();
                        if ($defaultVariant) {
                            $content = $defaultVariant->getContent();
                        }
                    }
                }

                $settings["tab{$i}_content"] = $content;
            }
        }

        return $settings;
    }
}