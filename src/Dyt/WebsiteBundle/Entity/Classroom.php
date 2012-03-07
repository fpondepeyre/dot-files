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
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="School", inversedBy="classrooms")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    protected $school;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="classroom", cascade={"persist"})
     * @var type
     */
    private $students;


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

    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set students
     *
     * @param ArrayCollection $students
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
        $students->setClassroom($this);
    }
}