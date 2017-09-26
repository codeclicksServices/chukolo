<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * this is for user working experience
 *
 * @ORM\Entity
 * @ORM\Table(name="workExperience")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\XPRepository")
 *  @Vich\Uploadable
 */
class XP
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $started;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $ended;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $organization;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $position;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $role;


    /*relationship*/


    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="xp")
     * @ORM\JoinColumn(name="owner_id",referencedColumnName="id", nullable=false )
     */
    protected $owner;





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
     * Set title
     *
     * @param string $title
     *
     * @return XP
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set started
     *
     * @param \DateTime $started
     *
     * @return XP
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set ended
     *
     * @param \DateTime $ended
     *
     * @return XP
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;

        return $this;
    }

    /**
     * Get ended
     *
     * @return \DateTime
     */
    public function getEnded()
    {
        return $this->ended;
    }

    /**
     * Set organization
     *
     * @param string $organization
     *
     * @return XP
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return XP
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return XP
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\Member $owner
     *
     * @return XP
     */
    public function setOwner(\AppBundle\Entity\Member $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\Member
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
