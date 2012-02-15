<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\School;
use Dyt\WebsiteBundle\Entity\User;

class LoadSchoolData extends AbstractFixture implements OrderedFixtureInterface {

    function load(ObjectManager $manager) {
        $users = array(
            array('username' => 'florian', 'email' => 'fpondepeyre@gmail.com', 'password' => 'pass4florian',
                'school' => 'Ecole Jean Moulin'),
            array('username' => 'laurent', 'email' => 'laurent.chavane@gmail.com', 'password' => 'pass4laurent',
                'school' => 'Ecole de Borest')
        );

        foreach ($users as $user) {
            $rowU = new User();
            $rowU->setUsername($user['username']);
            $rowU->setEmail($user['email']);
            $rowU->setPassword($user['password']);
            $manager->persist($rowU);
            $manager->flush();

            $rowS = new School();
            $rowS->setName($user['school']);
            $rowS->setUser($rowU);
            $manager->persist($rowS);
            $manager->flush();

            $this->addReference($user['username'], $rowS);
        }
    }

    public function getOrder() {
        return 1;
    }

}