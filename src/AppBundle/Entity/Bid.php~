<?php

namespace AppBundle\Entity;


use AppBundle\Model\TimeStampInterface;
use AppBundle\Model\TimeStampTrait;
use AppBundle\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="bids")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BidRepository")
 */
class Bid implements TimeStampInterface
{
  use TimeStampTrait;



    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(type="integer")
    */
    protected $price;
    /**
     * @ORM\Column(type="integer",options={"comment":"value: numbers of days it will take to deliver "})
     */
    protected $deliveryDays;
    /**
     * @ORM\Column(type="integer")
     */
    protected $commission;
    /**
     * @ORM\Column(type="text",nullable=true,options={"comment":"value: short note why you should get the job"})
     */
    protected $proposal;
    /**
     * @ORM\Column(type="integer",options={"comment":"value: bid price + commission which will be debited from the employer " })
     */
    protected $value;
    /**
     * @ORM\Column(type="string", length=30,options={"comment":"bid states include proposal,contract"})
     */
    protected $state;
    /**
     * @ORM\Column(type="string", length=30,options={"comment":"bid stages include created,declined,awarded,progress,paused,terminated,completed"})
     */
    protected $stage;
    /**
     * @ORM\Column(type="smallint",options={"default":0,"comment":"value: is 0 and 1(yes/no)"})
     */
    protected $withdrawn;

    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"value: is 0 and 1(yes/no) when wit"})
     */
    protected $awarded;

    /**
     * @ORM\Column(type="smallint",options={"default":1})
     */
    protected $visible;
    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"help to toggle the proposal list"})
     */
    protected $bookmark;



    /**
     * @ORM\Column(type="date",nullable=true,options={"comment":"the actual day you delivered the job"})
     */
    protected $deliveryDate;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;
    /**
     * @ORM\Column(type="date",nullable=true,options={"comment":"the day you started the project "})
     */
    protected $startDate;
    /**
     * @ORM\Column(type="datetime",nullable=true,options={"comment":"the day you are supoz to end the project which is gotten from start day from number of days to finishe "})
     * date created
     */
    protected $endDate;

    /**
     *relships
     * project
     * who is biding
     * suscriptions
     */



    //relationship
    /**
     * @ORM\ManyToOne(targetEntity="Project",inversedBy="bid")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="bid")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    protected $member;

    /**
     * @ORM\ManyToMany(targetEntity="Subscription", inversedBy="bid")
     * @ORM\JoinTable(name="bid_subscriptions")
     */
    private $subscription;

    /**
     *  @ORM\OneToMany(targetEntity="Milestone", mappedBy="contract")
     */
    protected $milestone;

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
     * Set price
     *
     * @param integer $price
     *
     * @return Bid
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
     * Set deliveryDays
     *
     * @param integer $deliveryDays
     *
     * @return Bid
     */
    public function setDeliveryDays($deliveryDays)
    {
        $this->deliveryDays = $deliveryDays;

        return $this;
    }

    /**
     * Get deliveryDays
     *
     * @return integer
     */
    public function getDeliveryDays()
    {
        return $this->deliveryDays;
    }

    /**
     * Set commission
     *
     * @param integer $commission
     *
     * @return Bid
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
     * @param integer $value
     *
     * @return Bid
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Bid
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set visible
     *
     * @param integer $visible
     *
     * @return Bid
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return integer
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set deliveryDate
     *
     * @param \DateTime $deliveryDate
     *
     * @return Bid
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    /**
     * Get deliveryDate
     *
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Bid
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Bid
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

    /**
     * Set proposal
     *
     * @param string $proposal
     *
     * @return Bid
     */
    public function setProposal($proposal)
    {
        $this->proposal = $proposal;

        return $this;
    }

    /**
     * Get proposal
     *
     * @return string
     */
    public function getProposal()
    {
        return $this->proposal;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subscription = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     *
     * @return Bid
     */
    public function addSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscription[] = $subscription;

        return $this;
    }

    /**
     * Remove subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     */
    public function removeSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscription->removeElement($subscription);
    }

    /**
     * Get subscription
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set stage
     *
     * @param string $stage
     *
     * @return Bid
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
     * Add milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     *
     * @return Bid
     */
    public function addMilestone(\AppBundle\Entity\Milestone $milestone)
    {
        $this->milestone[] = $milestone;

        return $this;
    }

    /**
     * Remove milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     */
    public function removeMilestone(\AppBundle\Entity\Milestone $milestone)
    {
        $this->milestone->removeElement($milestone);
    }

    /**
     * Get milestone
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMilestone()
    {
        return $this->milestone;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Bid
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set withdrawn
     *
     * @param integer $withdrawn
     *
     * @return Bid
     */
    public function setWithdrawn($withdrawn)
    {
        $this->withdrawn = $withdrawn;

        return $this;
    }

    /**
     * Get withdrawn
     *
     * @return integer
     */
    public function getWithdrawn()
    {
        return $this->withdrawn;
    }

    /**
     * Set bookmark
     *
     * @param integer $bookmark
     *
     * @return Bid
     */
    public function setBookmark($bookmark)
    {
        $this->bookmark = $bookmark;

        return $this;
    }

    /**
     * Get bookmark
     *
     * @return integer
     */
    public function getBookmark()
    {
        return $this->bookmark;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Bid
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Bid
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set awarded
     *
     * @param integer $awarded
     *
     * @return Bid
     */
    public function setAwarded($awarded)
    {
        $this->awarded = $awarded;

        return $this;
    }

    /**
     * Get awarded
     *
     * @return integer
     */
    public function getAwarded()
    {
        return $this->awarded;
    }
}
