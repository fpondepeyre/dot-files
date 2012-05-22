<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Form to edit simple label
 *
 */
class LabelCustomType extends AbstractType
{
    /**
     * Configure form
     *
     * @param \Symfony\Component\Form\FormBuilder $builder The form builder
     * @param array                               $options The form options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('template', 'textarea', array(
            'attr' => array(
                'class' => 'textarea-modal'
            )
        ));
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
