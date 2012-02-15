<?php

namespace Dyt\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="ref_level")
 */
class RefLevel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $culture;
    
    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $level;
    
    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $short_level;
    
    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="ref_level")
     */
    protected $students;

    public function __construct()
    {
        $this->students = new ArrayCollection();
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
     * Set culture
     *
     * @param string $culture
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
    }

    /**
     * Get culture
     *
     * @return string 
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * Set level
     *
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set short_level
     *
     * @param string $shortLevel
     */
    public function setShortLevel($shortLevel)
    {
        $this->short_level = $shortLevel;
    }

    /**
     * Get short_level
     *
     * @return string 
     */
    public function getShortLevel()
    {
        return $this->short_level;
    }

    /**
     * Add students
     *
     * @param Dyt\WebsiteBundle\Entity\Student $students
     */
    public function addStudent(\Dyt\WebsiteBundle\Entity\Student $students)
    {
        $this->students[] = $students;
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
}