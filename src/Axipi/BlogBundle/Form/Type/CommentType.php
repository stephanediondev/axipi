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

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

use Axipi\GoogleBundle\Form\Type\RecaptchaType;
use Axipi\CoreBundle\Entity\Comment;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('message', TextareaType::class,
            [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'cols' => 45,
                    'rows' => 8,
                ],
            ]
        );

        $builder->add('author', TextType::class,
            [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ]
        );

        $builder->add('email', TextType::class,
            [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ]
        );

        $builder->add('website', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('recaptcha', RecaptchaType::class, []);

        $builder->add('submit', SubmitType::class,
            [
                'attr' => [
                    'class' => 'submit',
                ],
            ]
        );
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            $child->vars['label'] = 'blog.'.$name;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_blog',
            'data_class' => Comment::class,
        ));
    }
}
