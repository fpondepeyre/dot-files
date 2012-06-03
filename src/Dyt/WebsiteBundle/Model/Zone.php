<?php

namespace Dyt\WebsiteBundle\Model;

use Dyt\WebsiteBundle\Model\om\BaseZone;


/**
 * Skeleton subclass for representing a row from the 'zone' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.src.Dyt.WebsiteBundle.Model
 */
class Zone extends BaseZone
{
    /**
     * Update or insert zone
     * Get zone by label and name. If not found, create the zone object
     *
     * @param Label $label
     * @param $name
     * @param $template
     */
    public static function upsert(Label $label, $name, $template = null)
    {
        $zone = ZoneQuery::create()
            ->filterByLabel($label)
            ->filterByName($name)
            ->findOneOrCreate();

        $zone->setTemplate($template);
        $zone->save();
    }

} // Zone
