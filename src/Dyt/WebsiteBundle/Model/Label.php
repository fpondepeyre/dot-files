<?php

namespace Dyt\WebsiteBundle\Model;

use Dyt\WebsiteBundle\Model\om\BaseLabel;
use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementBuilder;
use Dyt\WebsiteBundle\Lib\LabelElement\CustomElement;

/**
 * Skeleton subclass for representing a row from the 'label' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.src.Dyt.WebsiteBundle.Model
 */
class Label extends BaseLabel
{
    public function getDataByZone()
    {
        $labelElementBuilder = new LabelElementBuilder();

        foreach($this->getZones() as $zone) {
            $customElement = new CustomElement($this->getClassroom());
            $customElement->setTemplate($zone->getTemplate());
            $labelElementBuilder->setLabelElement($customElement);
            $data[$zone->getName()] = $labelElementBuilder->render();
        }

        return $data;
    }
} // Label
