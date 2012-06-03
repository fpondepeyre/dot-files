<?php

namespace Dyt\WebsiteBundle\Model;

use Dyt\WebsiteBundle\Model\om\BaseLabel;
use Dyt\WebsiteBundle\Lib\LabelElement\StandardElement;

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
    /**
     * Render all zones
     *
     * @param array $customLabel
     * @return array
     */
    public function getDataByZone($customLabel = null)
    {
        $data = array();

        foreach ($this->getZones() as $zone) {
            $customElement = new StandardElement($this->getClassroom());
            $customElement->setTemplate($zone->getTemplate());

            $keys = ($customLabel)? array_keys($customLabel) : array();
            if (in_array($zone->getName(), $keys)) {
                $data[$zone->getName()] = $customLabel[$zone->getName()];
            } else {
                $data[$zone->getName()] = $customElement->renderElement();
            }
        }

        return $data;
    }

} // Label
