<?php

namespace Gwd\Bundle\ResellerBundle\Form\Type;

use Gwd\Bundle\ResellerBundle\Entity\ResellerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Oro\Bundle\AttachmentBundle\Form\Type\ImageType;

class ResellerFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('name',TextType::class,[
               'label'=>'Name',
               'required'=>true
           ])
           ->add('email', EmailType::class, [
               'label' => 'Email',
               'required' => false,
           ])
           ->add('phone', TextType::class, [
               'label' => 'Phone',
               'required' => false,
           ])
           ->add('address', TextareaType::class, [
               'label' => 'Address',
               'required' => false,
           ])
           ->add('website', UrlType::class, [
               'label' => 'Website',
               'required' => false,
           ])
           ->add('description', TextareaType::class, [
               'label' => 'Description',
               'required' => false,
           ])
           ->add('authorized', CheckboxType::class, [
               'label' => 'Authorized',
               'required' => false,
           ])
           ->add('status', ChoiceType::class, [
               'label' => 'Status',
               'choices' => [
                   'Active' => 'active',
                   'Inactive' => 'inactive',
               ],
               'required' => true,
           ])
           ->add('logo', ImageType::class, [
               'label' => 'Logo',
               'required' => false,
           ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           'data_class'=>ResellerType::class,
       ]);
    }


    public function getBlockPrefix():string
    {
        return 'gwd_reseller';
    }
}