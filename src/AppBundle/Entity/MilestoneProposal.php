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
 * @ORM\Table(name="milestone_proposals")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MilestoneProposalsRepository")
 */
class MilestoneProposal
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
     * @ORM\Column(type="string", nullable=false,length=100)
     */
    private $description;
    /**
     * @ORM\Column(type="string",options={"default":0,"comment":"value: proposal or offer  the freelancer propose and the employer offers"})
     */
    private $type;
    /**
     * @ORM\Column(type="string",options={"default":"pending","comment":"value: is either pending, accept or decline "})
     */
    private $status;
    /**
     * @ORM\Column(type="string",options={"comment":"value: this is used to know if this is the first milestone second or third then all currently cus we can only create 2 max we have 1st and final"})
     */
    private $stage;
    /**
     * @ORM\Column(type="string",options={"comment":"value: the value starts from m1, m2, m3 etc"})
     */
    private $milestoneCode;
      /*
       * relationship
       * milestone for a who through what contract which is the fund
       * by  member
       * for project
       */

    /**
     * contract is the same thing as bid after is awarded
     * @ORM\ManyToOne(targetEntity="Bid", inversedBy="milestoneProposal")
     * @ORM\JoinColumn(name="bid_id",referencedColumnName="id" ,nullable=false)
     */
    protected $bid;


    /**
     * @ORM\OneToMany(targetEntity="Deliverable", mappedBy="milestoneProposal")
     */
    protected $deliverable;


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
     * @return MilestoneProposal
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
     * @return MilestoneProposal
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
     * Set type
     *
     * @param string $type
     *
     * @return MilestoneProposal
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return MilestoneProposal
     */
    public function setBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get bid
     *
     * @return \AppBundle\Entity\Bid
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * Set stage
     *
     * @param string $stage
     *
     * @return MilestoneProposal
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return string
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return MilestoneProposal
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set milestoneCode
     *
     * @param string $milestoneCode
     *
     * @return MilestoneProposal
     */
    public function setMilestoneCode($milestoneCode)
    {
        $this->milestoneCode = $milestoneCode;

        return $this;
    }

    /**
     * Get milestoneCode
     *
     * @return string
     */
    public function getMilestoneCode()
    {
        return $this->milestoneCode;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->deliverable = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add deliverable
     *
     * @param \AppBundle\Entity\Deliverable $deliverable
     *
     * @return MilestoneProposal
     */
    public function addDeliverable(\AppBundle\Entity\Deliverable $deliverable)
    {
        $this->deliverable[] = $deliverable;

        return $this;
    }

    /**
     * Remove deliverable
     *
     * @param \AppBundle\Entity\Deliverable $deliverable
     */
    public function removeDeliverable(\AppBundle\Entity\Deliverable $deliverable)
    {
        $this->deliverable->removeElement($deliverable);
    }

    /**
     * Get deliverable
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeliverable()
    {
        return $this->deliverable;
    }


    /**
     * @return boolean
     */
    public function hasDeliverable()
    {
        if($this->getDeliverable()){
            return true;
        }
        return false;
    }




}
