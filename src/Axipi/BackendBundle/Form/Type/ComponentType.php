<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Component;

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*->add('category', EntityType::class,
            [
                'class' => Category::class,
                'choices' => $options['categories'],
                'choice_label' => function ($category) {
                    return $category->getCode();
                }
            ])*/

        $builder
            ->add('zoneId')
            ->add('service')
            ->add('code')
            ->add('parent')
            ->add('icon')
            ->add('isUnique')
            ->add('isSearch')
            ->add('isSitemap')
            ->add('isActive')
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Component::class,
            'categories' => [],
        ));
    }
}
