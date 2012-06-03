<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * CustomElement class
 * Render a custom zone label
 *
 */
class StandardElement extends LabelElementAbstract
{
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
        return array(
            'student'      => $this->getStudent(),
            'firstInitial' => substr(ucfirst($this->getStudent()->getFirstName()), 0, 1),
            'firstname'    => $this->getStudent()->getFirstName(),
            'lastInitial'  => substr(ucfirst($this->getStudent()->getLastName()), 0, 1),
            'lastName'     => $this->getStudent()->getLastName(),
            'firstName'    => $this->getStudent()->getFirstName()
        );
    }

} //CustomElement
