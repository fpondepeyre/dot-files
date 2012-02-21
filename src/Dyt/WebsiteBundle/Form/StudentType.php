<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StudentType extends AbstractType
{   
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            //->add('birthday')
            //->add('sexe')
            //->add('classroom')
            ->add('ref_level')
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
