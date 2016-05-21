<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\CoreBundle\Entity\Page;
use Axipi\CoreBundle\Entity\WidgetPage;

class WidgetPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('page', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Page::class,
                'choices' => $options['pages'],
                'choice_label' => function ($page) {
                    return $page->getTitle();
                }
            ]
        );
        $builder->add('title');
        $builder->add('ordering');
        $builder->add('isActive');
        $builder->add('submit', SubmitType::class);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name != 'submit') {
                $child->vars['label'] = 'widget_page.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => WidgetPage::class,
            'widget_page' => null,
            'pages' => [],
        ));
    }
}
