<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * CustomElement class
 * Render a custom zone label
 *
 */
class CustomElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'custom';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Custom';

    /**
     * The twig template
     *
     * @var $template
     */
    private $template;

    /**
     * Set the twig template
     *
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * Get the twig templace
     *
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * The twig template
     *
     * @return string
     */
    public function getTwigTemplate()
    {
        $template = $this->getTemplate();

        return $template;
    }

    /**
     * Get the twig variables
     *
     * @return array
     */
    public function getTwigVariables()
    {
        return array('student' => $this->getStudent());
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
