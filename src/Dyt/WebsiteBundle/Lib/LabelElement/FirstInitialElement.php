<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * FirstInitialElement class
 * Get the first
 *
 */
class FirstInitialElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'first_name_initial';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'First initial';

    /**
     * The first name initial render
     *
     * {@inheritdoc}
     * @return string
     */
    public function renderElement()
    {
        return substr($this->getStudent()->getFirstName(), 0, 1);
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
