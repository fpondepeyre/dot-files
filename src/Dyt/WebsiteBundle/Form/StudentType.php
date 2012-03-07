<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('first_name', 'text', array('attr' => array('class' => 'input-small')))
            ->add('last_name', 'text', array('attr' => array('class' => 'input-medium')))
            ->add('birthday', null, array('widget' => 'single_text'))
            ->add('sex', 'text', array('attr' => array('class' => 'input-small')))
            ->add('ref_level', null, array('attr' => array('class' => 'input-small')))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dyt\WebsiteBundle\Entity\Student',
        );
    }

    public function getName()
    {
        return 'student';
    }
}
