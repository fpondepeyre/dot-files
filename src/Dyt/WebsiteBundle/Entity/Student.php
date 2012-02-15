<?php

namespace Dyt\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Classroom", inversedBy="students")
     * @ORM\JoinColumn(name="classroom_id", referencedColumnName="id")
     */
    protected $classroom;

    /**
     * @ORM\ManyToOne(targetEntity="RefLevel", inversedBy="students")
     * @ORM\JoinColumn(name="ref_level_id", referencedColumnName="id")
     */
    protected $ref_level;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $last_name;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $birthday;

    /**
     * @ORM\Column(type="string", length=1)
     */
    protected $sexe;


    public function __construct()
    {
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    }

    /**
     * Get first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    }

    /**
     * Get last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set birthday
     *
     * @param date $birthday
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * Get birthday
     *
     * @return date
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set classroom
     *
     * @param Dyt\WebsiteBundle\Entity\Classroom $classroom
     */
    public function setClassroom(\Dyt\WebsiteBundle\Entity\Classroom $classroom)
    {
        $this->classroom = $classroom;
    }

    /**
     * Get classroom
     *
     * @return Dyt\WebsiteBundle\Entity\Classroom
     */
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * Set ref_level
     *
     * @param Dyt\WebsiteBundle\Entity\RefLevel $refLevel
     */
    public function setRefLevel(\Dyt\WebsiteBundle\Entity\RefLevel $refLevel)
    {
        $this->ref_level = $refLevel;
    }

    /**
     * Get ref_level
     *
     * @return Dyt\WebsiteBundle\Entity\RefLevel
     */
    public function getRefLevel()
    {
        return $this->ref_level;
    }
}