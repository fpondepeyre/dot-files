<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('students', 'collection', array(
                'type'         => new StudentType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false
            )
        );
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
            'data_class' => 'Dyt\WebsiteBundle\Model\Classroom',
        );
    }

    /**
     * Get the form name
     *
     * @return string The form name
     */
    public function getName()
    {
        return 'classroom';
    }
}
