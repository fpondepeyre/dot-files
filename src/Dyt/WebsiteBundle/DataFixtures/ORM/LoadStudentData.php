<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\Student;

class LoadStudentData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $students[] = array(
            'firstname' => 'Tristan',
            'lastname'  => 'RANA-COEUGNET',
            'classroom' => 'classroom1',
            'level'     => 'PS',
            'sex'       => 1,
            'birthday'  => '2008-01-06'
        );

        $students[] = array(
            'firstname' => 'Anaé',
            'lastname'  => 'REIGNIER',
            'classroom' => 'classroom1',
            'level'     => 'PS',
            'sex'       => 2,
            'birthday'  => '2008-02-09'
        );

        $students[] = array(
            'firstname' => 'Louise',
            'lastname'  => 'SEVRE',
            'classroom' => 'classroom1',
            'level'     => 'MS',
            'sex'       => 2,
            'birthday'  => '2007-12-21'
        );

        $students[] = array(
            'firstname' => 'Henri',
            'lastname'  => 'JACQUEAU',
            'classroom' => 'classroom1',
            'level'     => 'MS',
            'sex'       => 1,
            'birthday'  => '2007-04-01'
        );

        $students[] = array(
            'firstname' => 'Raphaël',
            'lastname'  => 'GALLOIS',
            'classroom' => 'classroom1',
            'level'     => 'MS',
            'sex'       => 1,
            'birthday'  => '2007-09-21'
        );

        $students[] = array(
            'firstname' => 'Mattéo',
            'lastname'  => 'LIMA DA CUNHA',
            'classroom' => 'classroom2',
            'level'     => 'MS',
            'sex' => 1,
            'birthday'  => '2007-04-19'
        );

        $students[] = array(
            'firstname' => 'Léna',
            'lastname'  => 'DJERMANI',
            'classroom' => 'classroom2',
            'level'     => 'MS',
            'sex'       => 2,
            'birthday'  => '2007-06-12'
        );

        $students[] = array(
            'firstname' => 'Héloïse',
            'lastname'  => 'ROGER',
            'classroom' => 'classroom2',
            'level'     => 'TPS',
            'sex'       => 2,
            'birthday'  => '2009-01-27'
        );

        $students[] = array(
            'firstname' => 'Camille',
            'lastname'  => 'LANCIAUX',
            'classroom' => 'classroom2',
            'level'     => 'TPS',
            'sex'       => 2,
            'birthday'  => '2009-01-21');

        $students[] = array(
            'firstname' => 'Faustine',
            'lastname'  => 'CHENE',
            'classroom' => 'classroom2',
            'level'     => 'PS',
            'sex'       => 2,
            'birthday'  => '2008-10-23'
        );

        $i = 0;
        foreach ($students as $student) {
            $i++;
            $row = new Student();
            $row->setFirstName($student['firstname']);
            $row->setLastName($student['lastname']);
            $row->setClassroom($manager->merge($this->getReference($student['classroom'])));
            $row->setRefLevel($manager->merge($this->getReference($student['level'])));
            $row->setsex($student['sex']);
            $row->setBirthday(date_create($student['birthday']));

            $manager->persist($row);
            $manager->flush();

            //$this->addReference("student$i", $row);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}