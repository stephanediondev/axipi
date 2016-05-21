<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Program;
use Axipi\CoreBundle\Entity\Component;
use Axipi\CoreBundle\Entity\Page;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('program', EntityType::class,
            [
                'placeholder' => '-',
                'class' => Program::class,
                'choices' => $options['programs'],
                'choice_label' => function ($program) {
                    return $program->getLanguage()->getTitle().' / '.$program->getCountry()->getTitle();
                }
            ])
            ->add('component', EntityType::class,
            [
                'placeholder' => '-',
                'class' => Component::class,
                'choices' => $options['components'],
                'choice_label' => function ($component) {
                    return $component->getTitle();
                }
            ])
            ->add('parent', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Page::class,
                'choices' => $options['pages'],
                'choice_label' => function ($page) {
                    return $page->getTitle();
                }
            ])
            ->add('code')
            ->add('slug')
            ->add('title')
            ->add('isActive')
            ->add('attributes')
            ->add('submit', SubmitType::class)
        ;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name != 'submit') {
                $child->vars['label'] = 'page.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Page::class,
            'programs' => [],
            'components' => [],
            'pages' => [],
        ));
    }
}
