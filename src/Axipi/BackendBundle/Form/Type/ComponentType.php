<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Component;
use Axipi\CoreBundle\Entity\Zone;

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category')
            ->add('zone', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Zone::class,
                'choices' => $options['zones'],
                'choice_label' => function ($zone) {
                    return $zone->getCode();
                }
            ])
            ->add('service')
            ->add('title')
            ->add('parent', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Component::class,
                'choices' => $options['components'],
                'choice_label' => function ($component) {
                    return $component->getTitle();
                }
            ])
            ->add('icon')
            ->add('isUnique')
            ->add('isSearch')
            ->add('isSitemap')
            ->add('isActive')
            ->add('attributesSchema')
            ->add('submit', SubmitType::class)
        ;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name != 'submit') {
                $child->vars['label'] = 'component.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Component::class,
            'components' => [],
            'zones' => [],
        ));
    }
}
