<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * FirstNameElement class
 * Get the first name element
 *
 */
class FirstNameElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'first_name';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'First name';

    /**
     *  The twig template
     *
     * @return string
     */
    public function getTwigTemplate()
    {
        $template = '{{ firstname }}';

        return $template;
    }

    /**
     * Get the twig variables
     *
     * @return array
     */
    public function getTwigVariables()
    {
        $firstname = $this->getStudent()->getFirstName();

        return array('firstname' => $firstname);
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

} //FirstNameElement
