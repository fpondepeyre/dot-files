<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Model\Classroom;

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
     * __construct method
     *
     * @param \Dyt\WebsiteBundle\Model\Classroom $classroom
     */
    public function __construct(Classroom $classroom)
    {
        $this->classroom = $classroom;
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
     */
    abstract public function renderElement();

    /**
     * Get the label element name
     *
     */
    abstract public function getName();

    /**
     * Get the element key
     *
     */
    abstract public function getKey();

} //LabelElementAbstract
