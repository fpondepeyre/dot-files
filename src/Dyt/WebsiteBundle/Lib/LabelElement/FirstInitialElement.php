<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * FirstInitialElement class
 * Get the firstname initial
 *
 */
class FirstInitialElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'first_name_initial';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'First initial';

    /**
     * The twig template
     *
     * @return string
     */
    public function getTwigTemplate()
    {
        $template = '{{ firstInitial }}';

        return $template;
    }

    /**
     * Get the twig variables
     *
     * @return array
     */
    public function getTwigVariables()
    {
        $firstInitial = substr(ucfirst($this->getStudent()->getFirstName()), 0, 1);

        return array('firstInitial' => $firstInitial);
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
