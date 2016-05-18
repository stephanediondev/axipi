<?php

namespace Project29k\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Project29k\CoreBundle\Entity\Type;
use Project29k\CoreBundle\Entity\Category;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class,
                [
                    'class' => Category::class,
                    'choices' => $options['categories'],
                    'choice_label' => function ($category) {
                        return $category->getCode();
                    }
                ])
            ->add('zoneId')
            ->add('controllerAlias')
            ->add('code')
            ->add('parent')
            ->add('icon')
            ->add('unique')
            ->add('search')
            ->add('isSitemap')
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
            'data_class' => Type::class,
            'categories' => [],
        ));
    }
}
