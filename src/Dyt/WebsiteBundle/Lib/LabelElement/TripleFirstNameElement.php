<?php

namespace Dyt\WebsiteBundle\Lib\LabelElement;

use Dyt\WebsiteBundle\Lib\LabelElement\LabelElementAbstract;

/**
 * TripleFirstNameElement class
 *
 */
class TripleFirstNameElement extends LabelElementAbstract
{
    /**
     * The element key
     *
     * @const KEY
     */
    const KEY = 'triple_first_name';

    /**
     * The element name
     *
     * @const NAME
     */
    const NAME = 'Triple first name';

    /**
     * The triple first name render
     *
     * {@inheritdoc}
     * @return string
     */
    public function renderElement()
    {
        $firstName = $this->getStudent()->getFirstName();

        return sprintf('<p class="schoolbell">%s</p><p class="alexbrush">%s</p><p class="maidenorange">%s</p>', $firstName, $firstName, $firstName);
    }

    /**
     * The element name
     *
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

} //TripleFirstNameElement
