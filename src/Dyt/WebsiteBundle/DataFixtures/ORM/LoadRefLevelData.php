<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\RefLevel;

class LoadRefLevelData extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $refLevels[] = array(
            'culture'     => 'fr',
            'level'       => 'Toute petite section',
            'short_level' => 'TPS'
        );

        $refLevels[] = array(
            'culture'     => 'fr',
            'level'       => 'Petite section',
            'short_level' => 'PS'
        );

        $refLevels[] = array(
            'culture'     => 'fr',
            'level'       => 'Moyenne section',
            'short_level' => 'MS'
        );

        $refLevels[] = array(
            'culture'     => 'fr',
            'level'       => 'Grande section',
            'short_level' => 'GS'
        );

        foreach ($refLevels as $refLevel) {
            $row = new RefLevel();
            $row->setCulture($refLevel['culture']);
            $row->setLevel($refLevel['level']);
            $row->setShortLevel($refLevel['short_level']);

            $manager->persist($row);
            $manager->flush();

            $this->addReference($refLevel['short_level'], $row);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
