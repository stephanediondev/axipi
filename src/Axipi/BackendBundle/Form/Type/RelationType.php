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

use Axipi\CoreBundle\Entity\Item;
use Axipi\CoreBundle\Entity\Relation;

class RelationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('parent', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Relation::class,
                'choices' => $options['relations'],
                'choice_label' => function ($relation) {
                    return $relation->getPage()->getTitle();
                }
            ]
        );

        $builder->add('page', EntityType::class,
            [
                'required' => true,
                'placeholder' => '-',
                'class' => Item::class,
                'choices' => $options['items'],
                'choice_label' => function ($page) {
                    return $page->getTitle();
                }
            ]
        );

        $builder->add('title', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('ordering', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('isActive');

        $builder->add('submit', SubmitType::class,
            [
                'label' => $options['relation']->getId() ? 'actions.update' : 'actions.create',
            ]
        );
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name == 'submit') {
            } else {
                $child->vars['label'] = 'relation.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Relation::class,
            'relation' => null,
            'relations' => [],
            'items' => [],
        ));
    }
}
