<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Zone;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('code', TextType::class,
            [
                'required' => true,
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
                'label' => $options['zone']->getId() ? 'actions.update' : 'actions.create',
            ]
        );
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name == 'submit') {
            } else {
                $child->vars['label'] = 'zone.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Zone::class,
            'zone' => null,
        ));
    }
}
