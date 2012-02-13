<?php

namespace Dyt\WebsiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="School", mappedBy="user")
     */
    protected $schools;

    public function __construct()
    {
        parent::__construct();
        
        $this->schools = new ArrayCollection();
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
     * Add schools
     *
     * @param Dyt\WebsiteBundle\Entity\School $schools
     */
    public function addSchool(\Dyt\WebsiteBundle\Entity\School $schools)
    {
        $this->schools[] = $schools;
    }

    /**
     * Get schools
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSchools()
    {
        return $this->schools;
    }
}