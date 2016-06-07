<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Item;
use Axipi\CoreBundle\Entity\Zone;
use Axipi\BackendBundle\Form\Type\AttributesType;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('template', TextType::class,
            [
                'required' => false,
                'attr' => [
                    'data-default' => $options['item']->getComponent()->getTemplate(),
                ],
            ]
        );

        $builder->add('parent', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Item::class,
                'choices' => $options['items'],
                'choice_label' => function ($item) {
                    return $item->getTitle();
                },
            ]
        );

        $builder->add('code', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('title', TextType::class,
            [
                'required' => true,
            ]
        );

        if($options['item']->getComponent()->getCategory() == 'page') {
            $builder->add('slug', TextType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('titleSeo', TextType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('descriptionSeo', TextareaType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('titleSocial', TextType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('descriptionSocial', TextareaType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('style', TextareaType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('meta', TextareaType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('script', TextareaType::class,
                [
                    'required' => false,
                ]
            );

            $builder->add('isHome');

            $builder->add('excludeSearch');

            $builder->add('excludeSitemap');
        }

        if($options['item']->getComponent()->getCategory() == 'widget') {
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
            $builder->add('ordering', TextType::class,
                [
                    'required' => true,
                ]
            );
        }

        $builder->add('attributesChange', AttributesType::class,
            [
                'mapped' => true,
                'required' => false,
                'object' => $options['item'],
                'data' => $options['item']->getAttributes()
            ]
        );

        $builder->add('isActive');

        $builder->add('submit', SubmitType::class);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name == 'submit') {
                $child->vars['label'] = 'actions.'.$name;
            } else {
                $child->vars['label'] = 'item.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Item::class,
            'item' => null,
            'items' => [],
            'zones' => [],
        ));
    }
}
