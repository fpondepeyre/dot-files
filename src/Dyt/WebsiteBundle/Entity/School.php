<?php

namespace Dyt\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="school")
 */
class School
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="schools")
     * @ORM\JoinColumn(name="fos_user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\OneToMany(targetEntity="Classroom", mappedBy="school")
     */
    protected $classrooms;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    public function __construct()
    {        
        $this->classrooms = new ArrayCollection();
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
     * Set user
     *
     * @param Dyt\WebsiteBundle\Entity\User $user
     */
    public function setUser(\Dyt\WebsiteBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Dyt\WebsiteBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add classrooms
     *
     * @param Dyt\WebsiteBundle\Entity\Classroom $classrooms
     */
    public function addClassroom(\Dyt\WebsiteBundle\Entity\Classroom $classrooms)
    {
        $this->classrooms[] = $classrooms;
    }

    /**
     * Get classrooms
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }
}