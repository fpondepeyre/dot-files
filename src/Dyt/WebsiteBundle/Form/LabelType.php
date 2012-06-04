<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Form to edit simple label
 *
 */
class LabelType extends AbstractType
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
            ->add('name', 'text', array(
                'attr' => array(
                    'placeholder' => 'Label name',
                    'class'       => 'input-large'
                )
            ))
            ->add('background', 'text', array(
                'attr' => array(
                    'placeholder' => 'Background color (#ffffff)',
                    'class'       => 'input-normal'
                )
            ))
            ->add('border', 'text', array(
                'attr' => array(
                    'placeholder' => 'Border style (solid 1px #000000)',
                    'class'       => 'input-normal'
                )
            ))
            ->add('template', 'hidden');
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
            'data_class' => 'Dyt\WebsiteBundle\Model\Label',
        );
    }

    /**
     * Get the form name
     *
     * @return string The form name
     */
    public function getName()
    {
        return 'label';
    }

} //ClassroomType
