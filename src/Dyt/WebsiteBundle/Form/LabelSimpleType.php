<?php

namespace Dyt\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Dyt\WebsiteBundle\Lib\LabelElement\FirstInitialElement;
use Dyt\WebsiteBundle\Lib\LabelElement\FirstNameElement;
use Dyt\WebsiteBundle\Lib\LabelElement\LastInitialElement;
use Dyt\WebsiteBundle\Lib\LabelElement\LastNameElement;

/**
 * Form to edit simple label
 *
 */
class LabelSimpleType extends AbstractType
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
            ->add('zone1', 'choice', array(
                'choices' => $this->getChoiceZones()
            ))
            ->add('zone2', 'choice', array(
                'choices' => $this->getChoiceZones(),
            ));
    }

    /**
     * Get the zone choices
     *
     * @return array The zone choices
     *
     */
    private function getChoiceZones()
    {
        return array(
            FirstInitialElement::KEY => FirstInitialElement::NAME,
            FirstNameElement::KEY    => FirstNameElement::NAME,
            LastInitialElement::KEY  => LastInitialElement::NAME,
            LastNameElement::KEY     => LastNameElement::NAME
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
