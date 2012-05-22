<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Model\Classroom;

/**
 * LabelElementFactory abstract
 *
 */
class LabelElementFactory
{
    /**
     * __construct method
     *
     */
    public function __construct()
    {

    }

    /**
     * Get the labelElement associate to the key parameter
     *
     * @param string                             $labelElementKey The label element key
     * @param \Dyt\WebsiteBundle\Model\Classroom $classroom       The classroom object
     *
     * @throws \Exception
     * @return \Dyt\WebsiteBundle\Lib\LabelElement\FirstInitialElement
     */
    public static function getLabelElement($labelElementKey, Classroom $classroom)
    {
        switch($labelElementKey) {
            case FirstInitialElement::KEY:
                return new FirstInitialElement($classroom);
                break;
            case FirstNameElement::KEY:
                return new FirstNameElement($classroom);
                break;
            case LastInitialElement::KEY:
                return new LastInitialElement($classroom);
                break;
            case LastNameElement::KEY:
                return new LastNameElement($classroom);
                break;
            case TripleFirstNameElement::KEY:
                return new TripleFirstNameElement($classroom);
                break;
            case CustomElement::KEY:
                return new CustomElement($classroom);
                break;
            default:
                throw new \Exception(sprintf('Unable to create the LabelElement with key "%s"', $labelElementKey));
        }
    }
} //LabelElementFactory
