<?php

namespace Dyt\WebsiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dyt\WebsiteBundle\Entity\School;
use Dyt\WebsiteBundle\Entity\User;

class LoadSchoolData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $users[] = array(
            'username' => 'florian',
            'email'    => 'fpondepeyre@gmail.com',
            'password' => 'pass4florian',
            'school'   => 'Ecole Jean Moulin',
            'enabled'  => true
        );

        $users[] = array(
            'username' => 'laurent',
            'email'    => 'laurent.chavane@gmail.com',
            'password' => 'pass4laurent',
            'school'   => 'Ecole de Borest',
            'enabled'  => true
        );

        foreach ($users as $user) {
            $rowU = new User();
            $rowU->setUsername($user['username']);
            $rowU->setEmail($user['email']);
            $rowU->setPlainPassword($user['password']);
            $rowU->setEnabled($user['enabled']);
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

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
