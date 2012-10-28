<?php

namespace Dyt\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

/**
 * RegistrationFormType
 *
 */
class RegistrationFormType extends BaseType
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

        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'), array('style' => 'span5'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type'           => 'password',
                'options'        => array('translation_domain' => 'FOSUserBundle'),
                'first_options'  => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation')
        ));
    }

    /**
     * {inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return 'dyt_user_registration';
    }
}
