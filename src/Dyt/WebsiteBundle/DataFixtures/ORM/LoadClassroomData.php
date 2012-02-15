<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\Classroom;

class LoadClassroomData extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $classroom = new Classroom();
        $classroom->setName('My classroom');
        $classroom->setSchool($manager->merge($this->getReference('florian')));

        $manager->persist($classroom);
        $manager->flush();
        
        $this->addReference('classroom1', $classroom);
        
        $classroom = new Classroom();
        $classroom->setName('My classroom');
        $classroom->setSchool($manager->merge($this->getReference('laurent')));

        $manager->persist($classroom);
        $manager->flush();
        
        $this->addReference('classroom2', $classroom);

    }
    
    public function getOrder()
    {
        return 2;
    }
}