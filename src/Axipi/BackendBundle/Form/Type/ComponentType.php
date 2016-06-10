<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Component;
use Axipi\CoreBundle\Entity\Zone;

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('zone', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Zone::class,
                'choices' => $options['zones'],
                'choice_label' => function ($zone) {
                    return $zone->getCode();
                }
            ]
        );

        $builder->add('service', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('template', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('title', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('parent', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Component::class,
                'choices' => $options['components'],
                'choice_label' => function ($component) {
                    return $component->getTitle();
                }
            ]
        );

        $builder->add('icon', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('isUnique');

        $builder->add('isHome');

        $builder->add('excludeSearch');

        $builder->add('excludeSitemap');

        $builder->add('isActive');

        $builder->add('attributesSchema');

        $builder->add('submit', SubmitType::class,
            [
                'label' => $options['component']->getId() ? 'actions.update' : 'actions.create',
            ]
        );
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name == 'submit') {
            } else {
                $child->vars['label'] = 'component.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Component::class,
            'component' => null,
            'components' => [],
            'zones' => [],
        ));
    }
}
