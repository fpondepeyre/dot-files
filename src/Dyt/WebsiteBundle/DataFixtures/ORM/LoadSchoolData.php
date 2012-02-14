<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\School;
use Dyt\WebsiteBundle\Entity\User;

class LoadSchoolData extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Florian');
        $user->setEmail('fpondepeyre@gmail.com');
        $user->setPassword('pass4florian');
        
        $manager->persist($user);
        $manager->flush();
        
        $school = new School();
        $school->setName("Ecole Jean Moulin");
        $school->setUser($user);

        $manager->persist($school);
        $manager->flush();
        
        $this->addReference('school', $school);
    }
    
    public function getOrder()
    {
        return 1;
    }
}