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

class ComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category')
            ->add('zoneId')
            ->add('service')
            ->add('title')
            ->add('parent')
            ->add('icon')
            ->add('isUnique')
            ->add('isSearch')
            ->add('isSitemap')
            ->add('isActive')
            ->add('save', SubmitType::class)
        ;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            $child->vars['label'] = 'component.' . $name;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Component::class,
            'categories' => [],
        ));
    }
}
