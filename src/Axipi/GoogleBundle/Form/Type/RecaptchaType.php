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
    private $sitekey;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $child->vars['attr']['data-sitekey'] = $options['googleRecaptchaSiteKey'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'mapped' => false,
            'compound' => false,
            'attr' => array(
                'data-sitekey' => '',//$this->sitekey,
                'class' => 'g-recaptcha'
            ),
            'constraints' => array(
                new Recaptcha(),
            ),
            'googleRecaptchaSiteKey' => '',
        ));
    }

    public function getBlockPrefix() {
        return 'axipi_google_form_type_recaptcha';
    }
}
