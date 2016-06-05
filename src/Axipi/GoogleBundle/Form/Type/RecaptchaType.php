<?php
namespace Axipi\GoogleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Axipi\GoogleBundle\Validator\Constraints\Recaptcha;

class RecaptchaType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'mapped' => false,
            'compound' => false,
            'attr' => array(
                'class' => 'g-recaptcha'
            ),
            'constraints' => array(
                new Recaptcha(),
            ),
        ));
    }

    public function getBlockPrefix() {
        return 'axipi_google_form_type_recaptcha';
    }
}
