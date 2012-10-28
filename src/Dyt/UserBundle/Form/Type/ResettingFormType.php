<?php

namespace Dyt\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * ResettingFormType
 *
 */
class ResettingFormType extends BaseType
{
    /**
     * {inheritdoc}
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    /**
     * {inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'dyt_user_resetting';
    }
}
