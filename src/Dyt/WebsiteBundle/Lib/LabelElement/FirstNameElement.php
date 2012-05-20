<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * FirstNameElement class
 * Get the first name element
 *
 */
class FirstNameElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'first_name';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'First name';

    /**
     * The first name render
     *
     * {@inheritdoc}
     * @return string
     */
    public function renderElement()
    {
        return $this->getStudent()->getFirstName();
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

} //FirstNameElement
