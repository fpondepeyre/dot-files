<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LabelFullType extends AbstractType
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
            ->add('zone1', 'choice', array(
                'choices' => $this->getChoiceZones()
            ))
            ->add('zone2', 'choice', array(
                'choices' => $this->getChoiceZones(),
            ))
            ->add('zone3', 'choice', array(
                'choices' => $this->getChoiceZones(),
            ));
    }

    private function getChoiceZones()
    {
        return array(
            'name'    => 'student name',
            'initial' => 'initial name'
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
