<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * TripleFirstNameElement class
 *
 */
class TripleFirstNameElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'triple_first_name';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Triple first name';

    /**
     * The triple first name render
     *
     * {@inheritdoc}
     * @return string
     */
    public function renderElement()
    {
        $firstName = $this->getStudent()->getFirstName();

        return sprintf('<p class="schoolbell">%s</p><p class="alexbrush">%s</p><p class="maidenorange">%s</p>', $firstName, $firstName, $firstName);
    }


    /**
     *  The twig template
     *
     * @return string
     */
    public function getTwigTemplate()
    {
        $template = '<p class="schoolbell">{{ firstName }}</p><p class="alexbrush">{{ firstName }}</p><p class="maidenorange">{{ firstName }}</p>';

        return $template;
    }

    /**
     * Get the twig variables
     *
     * @return array
     */
    public function getTwigVariables()
    {
        $firstName = $this->getStudent()->getFirstName();

        return array('firstName' => $firstName);
    }

    /**
     * The element name
     *
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * The element key
     *
     * @return string
     */
    public function getKey()
    {
        return self::KEY;
    }

} //TripleFirstNameElement
