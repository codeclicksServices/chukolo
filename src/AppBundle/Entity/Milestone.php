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
     * @ORM\Column(type="string",options={"comment":" value: the value starts from m1, m2, m3 etc"})
     */
    private $milestoneCode;

    /**
     * @ORM\Column(type="string",options={"comment":" value: this is a short description for this
      milestone if there is only one milestone for the project its going to be the same as the
     *     project name"})
     */
    private $name;
    /**
     * @ORM\Column(type="integer", length=80,options={"comment":"this is the amount the employer is paying for this milestone"})
     */
    private $price;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: this is the value that would be paid to chukolo account as commission for this project" })
     */
    protected $commission;
    /**
     * @ORM\Column(type="string",options={"comment":"value: bid price - commission this is what will be paid to the freelancer " })
     */
    protected $value;

    /**
     * @ORM\Column(type="integer",nullable=true, length=3,options={"comment":"this is in percentage from 1 to 100 % and the value is dependent on the completed deliverable point "})
     */
    private $completionRate;

    /**
     * @ORM\Column(type="text",options={"comment":" value: brief description of this "} )
     */
    private $description;
    /**
     * @ORM\Column(type="string", length=80,options={"comment":"value: pending, progress, pause,complete, delivered,paid"})
     */
    private $status;
    /**
     * @ORM\Column(type="string",nullable=true, length=80,options={"comment":"how long before you complete this milestone  value:days and hours"})
     */
    private $durationDay;

    /**
     * @ORM\Column(type="integer",options={"comment":"value: duration in hours "})
     */
    protected $durationHour;
    /**
     * @ORM\Column(type="integer",options={"comment":"value: total hour used "})
     */
    protected $usedHour;
    /**
     * @ORM\Column(type="integer",options={"comment":"value: hours remaining to due "})
     */
    protected $remainingHour;
    
    /**
     * @ORM\Column(type="datetime",nullable=true,options={"comment":"the date the milestone started work on"})
     * date created
     */
    protected $started;

    /**
     * @ORM\Column(type="datetime",nullable=true,options={"comment":"when to deliver this milestone"})
     * date created
     */
    protected $deadline;

    /**
     * @ORM\Column(type="datetime",nullable=true,options={"comment":"actual delivery date"})
     */
    protected $completionDate;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"used to make payment to the freelancer for the completed job"})
     */
    protected $releasePayment;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"used to start working on a mile stone. you cant start two milestone from the same project at the same time "})
     */
    protected $start;

    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"this would be complete when the money have been transferred to the freelancer"})
     */
    protected $complete;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"used to trigger payment after the milestone is completed "})
     */
    protected $awaitingPayment;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"used this value if the employer release the payment"})
     */
    protected $paid;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"used rending payment"})
     */
    protected $refundRequest;
    /**
     * @ORM\Column(type="string", length=80,options={"comment":"value: point here is added up to complete the over all project progress"})
     */
    private $point;

      /*
       * relationship
       * milestone for a who through what contract which is the fund
       * by  member
       * for project
       */

    /**
     * contract is the same thing as bid after is awarded
     * @ORM\ManyToOne(targetEntity="Bid", inversedBy="milestone")
     * @ORM\JoinColumn(name="contract_id",referencedColumnName="id", nullable=false )
     */
    protected $contract;


    /**
     * payer here is the member receiving bank
     * @ORM\ManyToOne(targetEntity="ContractInvoice", inversedBy="milestone")
     * @ORM\JoinColumn(name="invoice_id",referencedColumnName="id" )
     */
    protected $invoice;



    /**
     *
     * @ORM\OneToMany(targetEntity="ReservedFund", mappedBy="milestone")
     */
    protected $reservedFund;

    /**
     * @ORM\OneToMany(targetEntity="Deliverable", mappedBy="milestone")
     */
    protected $deliverable;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservedFund = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Milestone
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
     * Set price
     *
     * @param integer $price
     *
     * @return Milestone
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set completionRate
     *
     * @param integer $completionRate
     *
     * @return Milestone
     */
    public function setCompletionRate($completionRate)
    {
        $this->completionRate = $completionRate;

        return $this;
    }

    /**
     * Get completionRate
     *
     * @return integer
     */
    public function getCompletionRate()
    {
        return $this->completionRate;
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
     * Set status
     *
     * @param string $status
     *
     * @return Milestone
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
     * Set duration
     *
     * @param string $duration
     *
     * @return Milestone
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set started
     *
     * @param \DateTime $started
     *
     * @return Milestone
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
     * Set deadline
     *
     * @param \DateTime $deadline
     *
     * @return Milestone
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * Get deadline
     *
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * Set completionDate
     *
     * @param \DateTime $completionDate
     *
     * @return Milestone
     */
    public function setCompletionDate($completionDate)
    {
        $this->completionDate = $completionDate;

        return $this;
    }

    /**
     * Get completionDate
     *
     * @return \DateTime
     */
    public function getCompletionDate()
    {
        return $this->completionDate;
    }

    /**
     * Set releasePayment
     *
     * @param integer $releasePayment
     *
     * @return Milestone
     */
    public function setReleasePayment($releasePayment)
    {
        $this->releasePayment = $releasePayment;

        return $this;
    }

    /**
     * Get releasePayment
     *
     * @return integer
     */
    public function getReleasePayment()
    {
        return $this->releasePayment;
    }

    /**
     * Set start
     *
     * @param integer $start
     *
     * @return Milestone
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return integer
     */
    public function getStart()
    {
        return $this->start;
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
     * Set invoice
     *
     * @param \AppBundle\Entity\Invoice $invoice
     *
     * @return Milestone
     */
    public function setInvoice(\AppBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \AppBundle\Entity\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Add reservedFund
     *
     * @param \AppBundle\Entity\ReservedFund $reservedFund
     *
     * @return Milestone
     */
    public function addReservedFund(\AppBundle\Entity\ReservedFund $reservedFund)
    {
        $this->reservedFund[] = $reservedFund;

        return $this;
    }

    /**
     * Remove reservedFund
     *
     * @param \AppBundle\Entity\ReservedFund $reservedFund
     */
    public function removeReservedFund(\AppBundle\Entity\ReservedFund $reservedFund)
    {
        $this->reservedFund->removeElement($reservedFund);
    }

    /**
     * Get reservedFund
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservedFund()
    {
        return $this->reservedFund;
    }



    /**
     * Add deliverable
     *
     * @param \AppBundle\Entity\Deliverable $deliverable
     *
     * @return Milestone
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
     * Set milestoneCode
     *
     * @param string $milestoneCode
     *
     * @return Milestone
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
     * Set durationHour
     *
     * @param integer $durationHour
     *
     * @return Milestone
     */
    public function setDurationHour($durationHour)
    {
        $this->durationHour = $durationHour;

        return $this;
    }

    /**
     * Get durationHour
     *
     * @return integer
     */
    public function getDurationHour()
    {
        return $this->durationHour;
    }

    /**
     * Set usedHour
     *
     * @param integer $usedHour
     *
     * @return Milestone
     */
    public function setUsedHour($usedHour)
    {
        $this->usedHour = $usedHour;

        return $this;
    }

    /**
     * Get usedHour
     *
     * @return integer
     */
    public function getUsedHour()
    {
        return $this->usedHour;
    }

    /**
     * Set remainingHour
     *
     * @param integer $remainingHour
     *
     * @return Milestone
     */
    public function setRemainingHour($remainingHour)
    {
        $this->remainingHour = $remainingHour;

        return $this;
    }

    /**
     * Get remainingHour
     *
     * @return integer
     */
    public function getRemainingHour()
    {
        return $this->remainingHour;
    }

    /**
     * Set durationDay
     *
     * @param string $durationDay
     *
     * @return Milestone
     */
    public function setDurationDay($durationDay)
    {
        $this->durationDay = $durationDay;

        return $this;
    }

    /**
     * Get durationDay
     *
     * @return string
     */
    public function getDurationDay()
    {
        return $this->durationDay;
    }

    /**
     * Set point
     *
     * @param string $point
     *
     * @return Milestone
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return string
     */
    public function getPoint()
    {
        return $this->point;
    }



    /**
     * Set commission
     *
     * @param integer $commission
     *
     * @return Milestone
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return integer
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Milestone
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set awaitingPayment
     *
     * @param integer $awaitingPayment
     *
     * @return Milestone
     */
    public function setAwaitingPayment($awaitingPayment)
    {
        $this->awaitingPayment = $awaitingPayment;

        return $this;
    }

    /**
     * Get awaitingPayment
     *
     * @return integer
     */
    public function getAwaitingPayment()
    {
        return $this->awaitingPayment;
    }

    /**
     * Set paid
     *
     * @param integer $paid
     *
     * @return Milestone
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return integer
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set refundRequest
     *
     * @param integer $refundRequest
     *
     * @return Milestone
     */
    public function setRefundRequest($refundRequest)
    {
        $this->refundRequest = $refundRequest;

        return $this;
    }

    /**
     * Get refundRequest
     *
     * @return integer
     */
    public function getRefundRequest()
    {
        return $this->refundRequest;
    }
}
