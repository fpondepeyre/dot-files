<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * LastNameElement class
 * Get the last name element
 *
 */
class LastNameElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'last_name';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Last name';

    /**
     * The last name render
     *
     * {@inheritdoc}
     * @return string
     */
    public function renderElement()
    {
        return $this->getStudent()->getLastName();
    }

    /**
     * The element name
     *
     * {@inheritdoc}
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * The element key
     *
     * @return string
     */
    public function getKey()
    {
        return self::KEY;
    }

} //LastNameElement
