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
 * @ORM\Table(name="reviews")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReviewRepository")
 *  @Vich\Uploadable
 */
class Review
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
     * @ORM\Column(type="string", length=14, nullable=false,options={"comment":"value: employer or freelancer"})
     */
    protected $for;


    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $note;


    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: between 1 to 5 for rating"})
     *
     */
    private $onTime;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: between 1 to 5 for rating "})
     *
     */
    private $onBudget;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value:  between 1 to 5 for rating"})
     *
     */
    private $onSpecification;




    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="review")
     * @ORM\JoinColumn(name="member_id",referencedColumnName="id", nullable=true )
     */
    protected $member;





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
     * @return Review
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
     * Set for
     *
     * @param string $for
     *
     * @return Review
     */
    public function setFor($for)
    {
        $this->for = $for;

        return $this;
    }

    /**
     * Get for
     *
     * @return string
     */
    public function getFor()
    {
        return $this->for;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Review
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
     * Set onTime
     *
     * @param integer $onTime
     *
     * @return Review
     */
    public function setOnTime($onTime)
    {
        $this->onTime = $onTime;

        return $this;
    }

    /**
     * Get onTime
     *
     * @return integer
     */
    public function getOnTime()
    {
        return $this->onTime;
    }

    /**
     * Set onBudget
     *
     * @param integer $onBudget
     *
     * @return Review
     */
    public function setOnBudget($onBudget)
    {
        $this->onBudget = $onBudget;

        return $this;
    }

    /**
     * Get onBudget
     *
     * @return integer
     */
    public function getOnBudget()
    {
        return $this->onBudget;
    }

    /**
     * Set onSpecification
     *
     * @param integer $onSpecification
     *
     * @return Review
     */
    public function setOnSpecification($onSpecification)
    {
        $this->onSpecification = $onSpecification;

        return $this;
    }

    /**
     * Get onSpecification
     *
     * @return integer
     */
    public function getOnSpecification()
    {
        return $this->onSpecification;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Review
     */
    public function setMember(\AppBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \AppBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }
}
