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

use Axipi\CoreBundle\Entity\Program;
use Axipi\CoreBundle\Entity\Component;
use Axipi\CoreBundle\Entity\Zone;
use Axipi\CoreBundle\Entity\Widget;

class WidgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('program', EntityType::class,
            [
                'placeholder' => '-',
                'class' => Program::class,
                'choices' => $options['programs'],
                'choice_label' => function ($program) {
                    return $program->getLanguage()->getTitle().' / '.$program->getCountry()->getTitle();
                }
            ]
        );
        $builder->add('template', TextType::class,
            [
                'required' => false,
                'attr' => [
                    'placeholder' => $options['widget']->getComponent()->getTemplate(),
                ]
            ]
        );
        $builder->add('zone', EntityType::class,
            [
                'placeholder' => '-',
                'class' => Zone::class,
                'choices' => $options['zones'],
                'choice_label' => function ($zone) {
                    return $zone->getCode();
                }
            ]
        );
        $builder->add('code');
        $builder->add('title');
        $builder->add('isActive');
        $builder->add('attributesChange', AttributesType::class, ['mapped' => true, 'required' => false, 'object' => $options['widget'], 'data' => $options['widget']->getAttributes()]);
        $builder->add('submit', SubmitType::class);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name != 'submit') {
                $child->vars['label'] = 'widget.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => Widget::class,
            'widget' => null,
            'programs' => [],
            'components' => [],
            'zones' => [],
        ));
    }
}
