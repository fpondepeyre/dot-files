<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * LastNameElement class
 * Get the lastname element
 *
 */
class LastNameElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'last_name';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Last name';

    /**
     *  The twig template
     *
     * @return string
     */
    public function getTwigTemplate()
    {
        $template = '{{ lastName }}';

        return $template;
    }

    /**
     * Get the twig variables
     *
     * @return array
     */
    public function getTwigVariables()
    {
        $lastName = $this->getStudent()->getLastName();

        return array('lastName' => $lastName);
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

} //LastNameElement
