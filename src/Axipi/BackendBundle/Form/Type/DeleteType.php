<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DeleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('confirm', CheckboxType::class,
            [
                'required' => true,
                'mapped' => false,
            ]
        );

        $builder->add('submit', SubmitType::class,
            [
                'label' => 'actions.delete',
            ]
        );
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->children['confirm']->vars['label'] = 'actions.confirm';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
        ));
    }
}
