<?php

namespace Axipi\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AttributesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attributes = json_decode($options['object']->getComponent()->getAttributesSchema(), true);

        if(is_array($attributes)) {
            foreach($attributes as $key => $attribute) {
                if($attribute['type'] == 'Symfony\Component\Form\Extension\Core\Type\FileType') {
                   continue;
                }
                $attribute['options']['mapped'] = true;
                $attribute['options']['data_class'] = null;
                $attribute['options']['data'] = $options['object']->getAttribute($key);
                $builder->add($key, $attribute['type'], $attribute['options']);
            }
        }
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'axipi_backend',
            'object' => null,
        ));
    }
}
