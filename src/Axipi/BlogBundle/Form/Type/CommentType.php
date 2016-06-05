<?php
namespace Axipi\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Axipi\GoogleBundle\Form\Type\RecaptchaType;
use Axipi\CoreBundle\Entity\Comment;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('author', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('email', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('website', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('message', TextareaType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('recaptcha', RecaptchaType::class, ['googleRecaptchaSiteKey' => $options['googleRecaptchaSiteKey']]);

        $builder->add('submit', SubmitType::class);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name == 'submit') {
                $child->vars['label'] = 'actions.'.$name;
            } else {
                $child->vars['label'] = 'blog.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_blog',
            'data_class' => Comment::class,
            'googleRecaptchaSiteKey' => '',
        ));
    }
}
