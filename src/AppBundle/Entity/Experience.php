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
 * @ORM\Entity
 * @ORM\Table(name="experience")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExperienceRepository")
 *  @Vich\Uploadable
 */
class Experience
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;



    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $note;
    /**

    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: experience point"})
     *
     */
    private $point;

    /**
     *
     * @Vich\UploadableField(mapping="experience_file", fileNameProperty="badgeName")
     *
     * @var File
     */
    private $badgeFile;

    /**
     * @ORM\Column(type="string", nullable=true,length=255)
     *
     * @var string
     */
    private $badgeName;



    /*
     * relationship
     */

    /**
     * @ORM\ManyToMany(targetEntity="Member", mappedBy="experience")
     */
    private $member;


    /**
     * @return File
     */
    public function getBadgeFile()
    {
        return $this->badgeFile;
    }

    /**
     * @param string $badgeName
     *
     * @return Experience
     */
    public function setBannerName($badgeName)
    {
        $this->badgeName = $badgeName;

        return $this;
    }








    /**
     * Get bannerName
     *
     * @return string
     */
    public function getBadgeName()
    {
        return $this->badgeName;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->member = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Experience
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set note
     *
     * @param string $note
     *
     * @return Experience
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set point
     *
     * @param integer $point
     *
     * @return Experience
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return integer
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set badgeName
     *
     * @param string $badgeName
     *
     * @return Experience
     */
    public function setBadgeName($badgeName)
    {
        $this->badgeName = $badgeName;

        return $this;
    }

    /**
     * Add member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Experience
     */
    public function addMember(\AppBundle\Entity\Member $member)
    {
        $this->member[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \AppBundle\Entity\Member $member
     */
    public function removeMember(\AppBundle\Entity\Member $member)
    {
        $this->member->removeElement($member);
    }

    /**
     * Get member
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMember()
    {
        return $this->member;
    }
}
