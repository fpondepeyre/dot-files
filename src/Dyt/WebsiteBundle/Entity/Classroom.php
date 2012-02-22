<?php

namespace Dyt\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="classroom")
 */
class Classroom
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="classrooms")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    protected $school;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="classroom")
     */
    protected $students;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set school
     *
     * @param Dyt\WebsiteBundle\Entity\School $school
     */
    public function setSchool(\Dyt\WebsiteBundle\Entity\School $school)
    {
        $this->school = $school;
    }

    /**
     * Get school
     *
     * @return Dyt\WebsiteBundle\Entity\School
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Get students
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set Tags
     *
     * @param ArrayCollection $tags
     */
    public function setStudents(ArrayCollection $students)
    {
        $this->students = $students;
    }

    /**
     * Add students
     *
     * @param Dyt\WebsiteBundle\Entity\Student $students
     */
    public function addStudents(\Dyt\WebsiteBundle\Entity\Student $students)
    {
        $this->students[] = $students;
    }
}