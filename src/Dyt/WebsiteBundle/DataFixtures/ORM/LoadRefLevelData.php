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
        $refLevel = new RefLevel();
        $refLevel->setCulture('fr');
        $refLevel->setLevel('CP');
        $refLevel->setShortLevel('CP');
                
        $manager->persist($refLevel);
        $manager->flush();
            
        $this->addReference('refLevelCp', $refLevel);
    }
    
    public function getOrder()
    {
        return 3;
    }
}