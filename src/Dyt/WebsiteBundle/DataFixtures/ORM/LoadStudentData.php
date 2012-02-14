<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\Student;

class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $student = new Student();
        $student->setFirstName('Doe');
        $student->setLastName('John');
        $student->setClassroom($manager->merge($this->getReference('classroom')));
        $student->setRefLevel($manager->merge($this->getReference('refLevelCp')));
        $student->setSexe(1);
        $student->setBirthday(new \DateTime());
        
        $manager->persist($student);
        $manager->flush();
        
        $this->addReference('student1', $student);
    }
    
    public function getOrder()
    {
        return 4;
    }
}