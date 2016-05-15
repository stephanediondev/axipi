<?php

namespace Project29k\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorieId')
            ->add('zoneId')
            ->add('code')
            ->add('parent')
            ->add('icon')
            ->add('unique')
            ->add('search')
            ->add('sitemap')
            ->add('active')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project29k\CoreBundle\Entity\Type'
        ));
    }
}
