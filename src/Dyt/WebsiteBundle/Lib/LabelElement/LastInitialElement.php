<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * LastInitialElement class
 * Get the last name initial element
 *
 */
class LastInitialElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'last_name_initial';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Last initial';

    /**
     * The last name initial render
     *
     * {@inheritdoc}
     * @return string
     */
    public function renderElement()
    {
        return substr(ucfirst($this->getStudent()->getLastName()), 0, 1);
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

} //FirstInitialElement
