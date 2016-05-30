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

use Axipi\CoreBundle\Entity\Language;
use Axipi\CoreBundle\Entity\Component;
use Axipi\CoreBundle\Entity\Item;
use Axipi\BackendBundle\Form\Type\AttributesType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('template', TextType::class,
            [
                'required' => false,
                'attr' => [
                    'placeholder' => $options['page']->getComponent()->getTemplate(),
                ]
            ]
        );
        $builder->add('parent', EntityType::class,
            [
                'required' => false,
                'placeholder' => '-',
                'class' => Item::class,
                'choices' => $options['pages'],
                'choice_label' => function ($page) {
                    return $page->getTitle();
                }
            ]
        );
        $builder->add('code');
        $builder->add('title');
        $builder->add('slug');
        $builder->add('titleSeo');
        $builder->add('descriptionSeo');
        $builder->add('metaRobots');
        $builder->add('titleSocial');
        $builder->add('descriptionSocial');
        $builder->add('isActive');
        $builder->add('attributesChange', AttributesType::class, ['mapped' => true, 'required' => false, 'object' => $options['page'], 'data' => $options['page']->getAttributes()]);
        $builder->add('submit', SubmitType::class);
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
            'data_class' => Item::class,
            'page' => null,
            'pages' => [],
        ));
    }
}
