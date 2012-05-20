<?php

namespace Dyt\WebsiteBundle\Form\Service;

/**
 * LabelTypeFactory class
 *
 */
class LabelTypeFactory
{
    /**
     * __construct method
     */
    public function __construct() {

    }

    /**
     * Create label associate to a template
     *
     * @static
     * @param string $template The template name
     * @return \Dyt\WebsiteBundle\Form\LabelFullType|\Dyt\WebsiteBundle\Form\LabelSimpleType
     * @throws Exception
     */
    public static function getLabelType($template)
    {
        switch($template) {
            case 'simple':
                return new \Dyt\WebsiteBundle\Form\LabelSimpleType;
                break;
            case 'full':
                return new \Dyt\WebsiteBundle\Form\LabelFullType;
                break;
            default:
                throw new Exception('Unable to create the LabelType');
        }
    }


} //LabelTypeFactory

