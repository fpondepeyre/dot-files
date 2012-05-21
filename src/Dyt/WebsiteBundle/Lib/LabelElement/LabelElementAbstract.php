<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Model\Classroom;
use Twig_Environment;
use Twig_Loader_String;

/**
 * LabelElementAbstract abstract
 *
 */
abstract class LabelElementAbstract
{
    /**
     * The classroom object
     *
     * @var \Dyt\WebsiteBundle\Model\Classroom
     */
    public $classroom;

    /**
     * The twig object
     *
     * @var \Twig_Environment
     */
    public $twig;

    /**
     * __construct method
     *
     * @param \Dyt\WebsiteBundle\Model\Classroom $classroom
     * @param null|\Twig_Environment             $twigEnvironment
     */
    public function __construct(Classroom $classroom, Twig_Environment $twigEnvironment = null )
    {
        $this->twig = $twigEnvironment;
        if (!$twigEnvironment) {
            $this->twig = new Twig_Environment(new Twig_Loader_String());
        }

        $this->classroom = $classroom;
    }

    /**
     * Get twig
     *
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * Get the classroom object
     *
     * @return mixed
     */
    public function getClassrrom()
    {
        return $this->classroom;
    }

    /**
     * Get the student list
     *
     * @return mixed
     */
    public function getStudents()
    {
        return $this->getClassrrom()->getStudents();
    }

    /**
     * Get the first student
     *
     * @return mixed
     */
    public function getStudent()
    {
        return $this->getStudents()->getFirst();
    }

    /**
     * How to render the label element
     *
     * @return mixed
     */
    public function renderElement()
    {
        $render = $this->getTwig()->render($this->getTwigTemplate(), $this->getTwigVariables());

        return $render;
    }

    /**
     * The twig template
     *
     * @abstract
     * @return mixed
     */
    abstract public function getTwigTemplate();

    /**
     * The twig variables
     *
     * @abstract
     * @return mixed
     */
    abstract public function getTwigVariables();

    /**
     * Get the label element name
     *
     * @abstract
     * @return mixed
     */
    abstract public function getName();

    /**
     * Get the element key
     *
     * @abstract
     * @return mixed
     */
    abstract public function getKey();

} //LabelElementAbstract
