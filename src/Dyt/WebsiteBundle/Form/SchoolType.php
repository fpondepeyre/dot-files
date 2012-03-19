<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SchoolType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('classroom', 'ClassroomType');
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Dyt\WebsiteBundle\Entity\School',
        );
    }

    public function getName()
    {
        return 'school';
    }
}
