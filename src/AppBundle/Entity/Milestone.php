<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="milestones")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MilestoneRepository")
 */
class Milestone
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=80)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"used to make payment to the freelancer for the completed job"})
     */
    protected $released;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"this would be complete when the money have been transferred to the freelancer"})
     */
    protected $complete;

    /**
     * @ORM\Column(type="smallint",length=1, options={"default":0,"comment":"In case the employer accidentally create more than necessary mile stone"})
     *
     */
    protected $cancel;


      /*
       * relationship
       *
       * by  member
       * for project
       */

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="milestone")
     * @ORM\JoinColumn(name="employer_id",referencedColumnName="id", nullable=false )
     */
    protected $employer;

    /**
     * contract is the same thing as bid after is awarded
     * @ORM\ManyToOne(targetEntity="Bid", inversedBy="milestone")
     * @ORM\JoinColumn(name="contract_id",referencedColumnName="id", nullable=false )
     */
    protected $contract;




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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Milestone
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Milestone
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Milestone
     */
    public function setMember(\AppBundle\Entity\Member $member)
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


    /**
     * Set released
     *
     * @param integer $released
     *
     * @return Milestone
     */
    public function setReleased($released)
    {
        $this->released = $released;

        return $this;
    }

    /**
     * Get released
     *
     * @return integer
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * Set cancel
     *
     * @param integer $cancel
     *
     * @return Milestone
     */
    public function setCancel($cancel)
    {
        $this->cancel = $cancel;

        return $this;
    }

    /**
     * Get cancel
     *
     * @return integer
     */
    public function getCancel()
    {
        return $this->cancel;
    }

    /**
     * Set contract
     *
     * @param \AppBundle\Entity\Bid $contract
     *
     * @return Milestone
     */
    public function setContract(\AppBundle\Entity\Bid $contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return \AppBundle\Entity\Bid
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set complete
     *
     * @param integer $complete
     *
     * @return Milestone
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * Get complete
     *
     * @return integer
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * Set employer
     *
     * @param \AppBundle\Entity\Member $employer
     *
     * @return Milestone
     */
    public function setEmployer(\AppBundle\Entity\Member $employer)
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * Get employer
     *
     * @return \AppBundle\Entity\Member
     */
    public function getEmployer()
    {
        return $this->employer;
    }
}
