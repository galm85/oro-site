<?php

namespace Gwd\Bundle\CmsBundle\ContentWidget;

use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
use Oro\Bundle\CMSBundle\Entity\ContentWidget;
use Oro\Bundle\CMSBundle\Form\Type\WYSIWYGValueType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;




class TabsBlockWidget extends AbstractContentWidgetType
{

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
            ->add('tab1_title',TextType::class, [
                'label' => 'Tab 1 title',
                'required' => false
            ])
            ->add('tab1_content', TextareaType::class, [
                'label' => 'Tab 1 Content',
                'required' => false,
                'attr' => ['rows' => 5]
            ])
            ->add('tab2_title', TextType::class, [
                'label' => 'Tab 2 Title',
                'required' => false
            ])
            ->add('tab2_content', TextareaType::class, [
                'label' => 'Tab 2 Content',
                'required' => false,
                'attr' => ['rows' => 5]
            ])
            ->add('tab3_title', TextType::class, [
                'label' => 'Tab 3 Title',
                'required' => false
            ])
            ->add('tab3_content', TextareaType::class, [
                'label' => 'Tab 3 Content',
                'required' => false,
                'attr' => ['rows' => 5]
            ])
            ->add('tab4_title', TextType::class, [
            'label' => 'Tab 4 Title',
            'required' => false
            ])
            ->add('tab4_content', TextareaType::class, [
                'label' => 'Tab 4 Content',
                'required' => false,
                'attr' => ['rows' => 5]
            ])
            ->getForm();

        $form->setData($contentWidget->getSettings());
        return $form;
    }



    public function getWidgetData(ContentWidget $contentWidget): array
    {
        return $contentWidget->getSettings();
    }




}