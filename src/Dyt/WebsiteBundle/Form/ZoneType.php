<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Form to edit custom label
 *
 */
class ZoneType extends AbstractType
{
    /**
     * Configure form
     *
     * @param \Symfony\Component\Form\FormBuilder $builder The form builder
     * @param array                               $options The form options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'hidden')
            ->add('template', 'textarea', array(
                'attr' => array(
                    'class'      => 'tinymce textarea-modal',
                    'data-theme' => 'simple'
                )
            ));
    }

    /**
     * Get default options
     *
     * @param  array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dyt\WebsiteBundle\Model\Zone',
        );
    }

    /**
     * Get the form name
     *
     * @return string The form name
     */
    public function getName()
    {
        return 'zone';
    }

} //ZoneType
