<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * LastInitialElement class
 * Get the last name initial element
 *
 */
class LastInitialElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'last_name_initial';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Last initial';

    /**
     *  The twig template
     *
     * @return string
     */
    public function getTwigTemplate()
    {
        $template = '{{ lastInitial }}';

        return $template;
    }

    /**
     * Get the twig variables
     *
     * @return array
     */
    public function getTwigVariables()
    {
        $lastInitial = substr(ucfirst($this->getStudent()->getLastName()), 0, 1);

        return array('lastInitial' => $lastInitial);
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

} //FirstInitialElement
