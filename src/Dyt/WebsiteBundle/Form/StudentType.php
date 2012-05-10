<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Dyt\WebsiteBundle\Model\Student;

class StudentType extends AbstractType
{
    /**
     * Configure form
     *
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('first_name', 'text', array(
                'attr' => array(
                    'placeholder' => 'first name',
                    'class'       => 'input-small'
                )
            ))
            ->add('last_name', 'text', array(
                'attr' => array(
                    'placeholder' => "last name",
                    'class'       => 'input-medium'
                )
            ))
            ->add('birthday', null, array(
                'widget' => 'single_text',
            ))
            ->add('sex', 'choice', array(
                'choices' => array(
                    Student::SEX_BOY  => Student::SEX_BOY_STRING,
                    Student::SEX_GIRL => Student::SEX_GIRL_STRING
                ),
                'attr' => array(
                    'placeholder' => 'sex',
                    'class' => 'input-small'
                )
            ))
            ->add('ref_level', null, array(
                'attr' => array(
                    'placeholder' => 'level',
                    'class'       => 'input-small'
                )
            ));
    }

    /**
     * Get default options
     *
     * @param array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dyt\WebsiteBundle\Model\Student',
        );
    }

    /**
     * Get the form name
     *
     * @return string The form name
     */
    public function getName()
    {
        return 'student';
    }
}
