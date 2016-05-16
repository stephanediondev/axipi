<?php

namespace Project29k\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Project29k\CoreBundle\Entity\Type;
use Project29k\CoreBundle\Entity\Categorie;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //print_r($options);

        $builder
            ->add('categoryId', ChoiceType::class, ['choices' => $options['categories']])
            ->add('zoneId')
            ->add('controllerAlias')
            ->add('code')
            ->add('parent')
            ->add('icon')
            ->add('unique')
            ->add('search')
            ->add('sitemap')
            ->add('active')
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project29k\CoreBundle\Entity\Type',
            'categories' => [],
            'new_option' => false,
        ));
    }
}
