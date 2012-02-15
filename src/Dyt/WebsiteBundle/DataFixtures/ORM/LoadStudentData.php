<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\Student;

class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface {

    function load(ObjectManager $manager) {
        $students = array(
            array('firstname' => 'Tristan', 'lastname' => 'RANA-COEUGNET', 'classroom' => 'classroom1',
                'level' => 'PS', 'sexe' => 1, 'birthday' => '2008-01-06'),
            array('firstname' => 'Anaé', 'lastname' => 'REIGNIER', 'classroom' => 'classroom1',
                'level' => 'PS', 'sexe' => 2, 'birthday' => '2008-02-09'),
            array('firstname' => 'Louise', 'lastname' => 'SEVRE', 'classroom' => 'classroom1',
                'level' => 'MS', 'sexe' => 2, 'birthday' => '2007-12-21'),
            array('firstname' => 'Henri', 'lastname' => 'JACQUEAU', 'classroom' => 'classroom1',
                'level' => 'MS', 'sexe' => 1, 'birthday' => '2007-04-01'),
            array('firstname' => 'Raphaël', 'lastname' => 'GALLOIS', 'classroom' => 'classroom1',
                'level' => 'MS', 'sexe' => 1, 'birthday' => '2007-09-21'),
            array('firstname' => 'Mattéo', 'lastname' => 'LIMA DA CUNHA', 'classroom' => 'classroom2',
                'level' => 'MS', 'sexe' => 1, 'birthday' => '2007-04-19'),
            array('firstname' => 'Léna', 'lastname' => 'DJERMANI', 'classroom' => 'classroom2',
                'level' => 'MS', 'sexe' => 2, 'birthday' => '2007-06-12'),
            array('firstname' => 'Héloïse', 'lastname' => 'ROGER', 'classroom' => 'classroom2',
                'level' => 'TPS', 'sexe' => 2, 'birthday' => '2009-01-27'),
            array('firstname' => 'Camille', 'lastname' => 'LANCIAUX', 'classroom' => 'classroom2',
                'level' => 'TPS', 'sexe' => 2, 'birthday' => '2009-01-21'),
            array('firstname' => 'Faustine', 'lastname' => 'CHENE', 'classroom' => 'classroom2',
                'level' => 'PS', 'sexe' => 2, 'birthday' => '2008-10-23')
        );

        $i = 0;
        foreach ($students as $student) {
            $i++;
            $row = new Student();
            $row->setFirstName($student['firstname']);
            $row->setLastName($student['lastname']);
            $row->setClassroom($manager->merge($this->getReference($student['classroom'])));
            $row->setRefLevel($manager->merge($this->getReference($student['level'])));
            $row->setSexe($student['sexe']);
            $row->setBirthday(date_create($student['birthday']));

            $manager->persist($row);
            $manager->flush();

            //$this->addReference("student$i", $row);
        }
    }

    public function getOrder() {
        return 4;
    }

}