<?php

namespace Dyt\WebsiteBundle\Form\Service;
use Dyt\WebsiteBundle\Form\LabelSimpleType;
use Dyt\WebsiteBundle\Form\LabelFullType;

/**
 * LabelTypeFactory class
 *
 */
class LabelTypeFactory
{
    /**
     * __construct method
     *
     */
    public function __construct()
    {

    }

    /**
     * Create label type form associate to the template
     *
     * @param string $template The template name
     *
     * @static
     * @throws \Exception
     * @return \Dyt\WebsiteBundle\Form\LabelFullType|\Dyt\WebsiteBundle\Form\LabelSimpleType
     */
    public static function getLabelType($template)
    {
        switch($template) {
            case 'simple':
                return new LabelSimpleType();
                break;
            case 'full':
                return new LabelFullType();
                break;
            default:
                throw new \Exception(sprintf('Unable to create LabelType with the template name "%s"', $template));
        }
    }

} //LabelTypeFactory

