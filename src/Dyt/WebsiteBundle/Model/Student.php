<?php

namespace Dyt\WebsiteBundle\Model;

use Dyt\WebsiteBundle\Model\om\BaseStudent;


/**
 * Skeleton subclass for representing a row from the 'student' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.src.Dyt.WebsiteBundle.Model
 */
class Student extends BaseStudent
{
    /**
     *
     * @const SEX_BOY
     */
    const SEX_BOY =  0;

    /**
     *
     * @const SEX_GIRL;
     */
    const SEX_GIRL = 1;

    /**
     *
     * @const SEX_BOY_STRING
     */
    const SEX_BOY_STRING = 'boy';

    /**
     *
     * @const SEX_GIRL_STRING
     */
    const SEX_GIRL_STRING = 'girl';

    /**
     * Get the student sex
     *
     */
    public function getSexString()
    {
        switch($this->getSex()) {
            case self::SEX_BOY:
                $sexString = self::SEX_BOY_STRING;
                break;
            case self::SEX_GIRL:
                $sexString = self::SEX_GIRL_STRING;
                break;
        }

        return $sexString;
    }

} // Student
