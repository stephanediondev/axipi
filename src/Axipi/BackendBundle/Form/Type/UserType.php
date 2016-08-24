<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

use Axipi\CoreBundle\Entity\User;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', EmailType::class,
            [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ]
        );

        if($options['user']->getId()) {
            $required = false;
        } else {
            $required = true;
        }
        $builder->add('passwordChange', RepeatedType::class,
            [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => [
                    'attr' => [
                        'class' => 'password-field',
                    ],
                ],
                'required' => $required,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ]
        );

        $builder->add('firstname', TextType::class,
            [
                'required' => true,
            ]
        );

        $builder->add('lastname', TextType::class,
            [
                'required' => false,
            ]
        );

        $builder->add('rolesChange', ChoiceType::class,
            [
                'choices' => $options['roles'],
                'choice_label' => function ($value, $key, $index) {
                    return $value;
                },
                'multiple' => true,
                'data' => $options['user']->getRoles(),
                'attr' => array(
                    'size' => 10,
                ),
            ]
        );

        if($options['user_connected']->getid() != $options['user']->getid()) {
            $builder->add('isActive');
        }

        $builder->add('submit', SubmitType::class,
            [
                'label' => $options['user']->getId() ? 'actions.update' : 'actions.create',
            ]
        );
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        foreach($view->children as $name => $child) {
            if($name == 'submit') {
            } else {
                $child->vars['label'] = 'user.'.$name;
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'data_class' => User::class,
            'user' => null,
            'user_connected' => null,
            'roles' => [],
        ));
    }
}
