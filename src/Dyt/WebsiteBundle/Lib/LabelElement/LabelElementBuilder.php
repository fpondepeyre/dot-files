<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Model\Classroom;

/**
 *
 */
class LabelElementBuilder
{
    public $labelElement;
    public $classroom;

    public function __construct()
    {

    }

    public function setLabelElement(LabelElementAbstract $labelElement)
    {
        $this->labelElement = $labelElement;
    }

    public function getLabelElement()
    {
        return $this->labelElement;
    }

    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;
    }

    public function render()
    {
        return $this->getLabelElement()->renderElement();
    }
}
