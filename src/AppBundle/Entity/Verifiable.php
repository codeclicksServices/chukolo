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
 * @ORM\Table(name="verifiables")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VerifyRepository")
 *  @Vich\Uploadable
 */
class Verifiable
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



    /*
     * relationship
     */

    /**
     * @ORM\ManyToMany(targetEntity="Member", mappedBy="verified")
     */
    private $member;



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
     * @return Verifiable
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
     * @return Verifiable
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
     * @return Verifiable
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
     * Add member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Verifiable
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
