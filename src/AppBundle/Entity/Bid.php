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
    * @ORM\Column(type="integer",options={"comment":"value: total price the employer will pay " })
    */
    protected $price;
    /**
     * @ORM\Column(type="integer",options={"comment":"value: this is the project duration i.e the number of days it will take to deliver this project "})
     */
    protected $duration;
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
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $commission;
    /**
     * @ORM\Column(type="text",nullable=true,options={"comment":"value: short note why you should get the job"})
     */
    protected $proposal;
    /**
     * @ORM\Column(type="string",options={"comment":"value: bid price - commission this is what will be paid to the freelancer " })
     */
    protected $value;
    /**
     * @ORM\Column(type="integer",options={"comment":"value: for defining how many times the payment should be broken down i.e the maximum number of milestones " })
     */
    protected $numberOfMilestones;
    /**
     * @ORM\Column(type="string", length=30,options={"comment":"bid states include proposal,contract"})
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=30,
     *     options={"comment":"bid stages include draft, created,declined,awarded,progress,paused,terminated,completed"})
     */
    protected $stage;

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
     * @ORM\Column(type="datetime",nullable=true,options={"comment":"the day you started the project "})
     */
    protected $startDate;
    /**
     * @ORM\Column(type="datetime",nullable=true,options={"comment":"the day you are supoz to end the project which is gotten from start day from number of days to finishe "})
     * date created
     */
    protected $endDate;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: this is the worth of subscription this project has " })
     */
    protected $subscriptionsValue;

    /**
     * @ORM\Column(type="string", length=30,
     *     options={"comment":"this is use for keeping the state of bid creation from step 1 to 4  0=bidcreation1 = milestoneChoice,2=featureChoice, 3= summary and 4= completecreation this is when the stage is = created "})
     */
    protected $step;
    /**
     * @ORM\Column(type="smallint",options={"default":0,"comment":"value: is 0 and 1(yes/no)"})
     */
    protected $withdrawn;

    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"value: is 0 and 1(yes/no) when wit"})
     */
    protected $awarded;
    /**
     * @ORM\Column(type="date",nullable=true,options={"comment":"this is the day the project awarded to you would be expired "})
     */
    protected $awardExpireDate;
    /**
     * todo check if this not used remove it
     * @ORM\Column(type="smallint",options={"default":0, "comment":"for checking if bid has  Subscription"})
     */
    protected $hasSubscriptions;


    /**
     * @ORM\Column(type="smallint",options={"default":1})
     */
    protected $visible;
    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"help to toggle the proposal list"})
     */
    protected $bookmark;
    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"marking this bid as save makes it stands out so you can easily finish the award process"})
     */
    protected $saved;

    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"checks weather this bid has been reviewed or not"})
     */
    protected $moderated;
    /**
     * @ORM\Column(type="string",nullable=true, length=100,options={"comment":"the feedback after bid is moderated. Value: accepted or decline"})
     */
    protected $moderatorResponse;

    /**
     * @ORM\Column(type="string",nullable=true, length=100,options={"comment":"the feedback message is declined"})
     */
    protected $moderatorMessage;

    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"states weather the freelancer accepts the employer offer or not "})
     */
    protected $acceptOffer;
    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"states weather the project has started or not "})
     */
    protected $started;

    /**
     *relaships
     * project
     * who is biding
     * subscriptions
     */



    //relationship
    /**
     * @ORM\ManyToOne(targetEntity="Project",inversedBy="bid")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;

    /**
     *  @ORM\OneToMany(targetEntity="Attachment", mappedBy="contract")
     */
    protected $attachment;

    /**
     * member here is the bidder
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
     *  @ORM\OneToMany(targetEntity="MilestoneProposal", mappedBy="bid")
     */
    protected $milestoneProposal;

    /**
     * @ORM\OneToMany(targetEntity="ReservedFund", mappedBy="bid")
     */
    private $reservedFund;

    /**
     * @ORM\OneToMany(targetEntity="ChukoloFund", mappedBy="bid")
     */
    private $chukoloFund;



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
     * Has Subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     * @return boolean
     */
    public function hasSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        if($this->subscription->contains($subscription)){
            return true;
        }
        return false;
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

    /**
     * Set numberOfMilestones
     *
     * @param integer $numberOfMilestones
     *
     * @return Bid
     */
    public function setNumberOfMilestones($numberOfMilestones)
    {
        $this->numberOfMilestones = $numberOfMilestones;

        return $this;
    }

    /**
     * Get numberOfMilestones
     *
     * @return integer
     */
    public function getNumberOfMilestones()
    {
        return $this->numberOfMilestones;
    }


    /**
     * Add milestoneProposal
     *
     * @param \AppBundle\Entity\MilestoneProposal $milestoneProposal
     *
     * @return Bid
     */
    public function addMilestoneProposal(\AppBundle\Entity\MilestoneProposal $milestoneProposal)
    {
        $this->milestoneProposal[] = $milestoneProposal;

        return $this;
    }

    /**
     * Remove milestoneProposal
     *
     * @param \AppBundle\Entity\MilestoneProposal $milestoneProposal
     */
    public function removeMilestoneProposal(\AppBundle\Entity\MilestoneProposal $milestoneProposal)
    {
        $this->milestoneProposal->removeElement($milestoneProposal);
    }

    /**
     * Get milestoneProposal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMilestoneProposal()
    {
        return $this->milestoneProposal;
    }

    /**
     * milestone
     * @return boolean
     * check if this has milestone proposal at all
     */
    public function hasMilestoneProposal()
    {

        $subscriptions =$this->getMilestoneProposal();

        if($subscriptions->count()>0){
            $activeProposal=array();
            foreach ($subscriptions as $proposal){
                //if this proposal status is not declined add it as an active proposal
                if ($proposal->getStatus() != "declined"){
                    //make sure its not an offer
                    if($proposal->getType() == "proposal"){
                        $activeProposal = $proposal;
                    }
                }
            }
            if(!empty($activeProposal)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    /**
     * Has Subscription
     * @return boolean
     * check if this has milestone offer
     */
    public function hasMilestoneOffer()
    {

        $subscriptions =$this->getMilestoneProposal();
        if($subscriptions->count()>0){

            $activeProposal=array();
            foreach ($subscriptions as $proposal){
                //if this proposal status is not declined add it as an active proposal
                if ($proposal->getStatus() != "declined"){
                    //make sure its not an offer
                    if($proposal->getType() == "offer"){
                        $activeProposal = $proposal;
                    }
                }
            }
                if(!empty($activeProposal)) {
                        return true;
                    }else{
                        return false;
                }
        }else{
            return false;
        }

    }

    /**
     * Set step
     *
     * @param string $step
     *
     * @return Bid
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return string
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set hasSubscriptions
     *
     * @param integer $hasSubscriptions
     *
     * @return Bid
     */
    public function setHasSubscriptions($hasSubscriptions)
    {
        $this->hasSubscriptions = $hasSubscriptions;

        return $this;
    }

    /**
     * Get hasSubscriptions
     *
     * @return integer
     */
    public function getHasSubscriptions()
    {
        return $this->hasSubscriptions;
    }

    /**
     * Set subscriptionsValue
     *
     * @param integer $subscriptionsValue
     *
     * @return Bid
     */
    public function setSubscriptionsValue($subscriptionsValue)
    {
        $this->subscriptionsValue = $subscriptionsValue;

        return $this;
    }

    /**
     * Get subscriptionsValue
     *
     * @return integer
     */
    public function getSubscriptionsValue()
    {
        return $this->subscriptionsValue;
    }


    /**
     * Set reservedFund
     *
     * @param \AppBundle\Entity\ReservedFund $reservedFund
     *
     * @return Bid
     */
    public function setReservedFund(\AppBundle\Entity\ReservedFund $reservedFund = null)
    {
        $this->reservedFund = $reservedFund;

        return $this;
    }

    /**
     * Get reservedFund
     *
     * @return \AppBundle\Entity\ReservedFund
     */
    public function getReservedFund()
    {
        return $this->reservedFund;
    }

    /**
     * Add reservedFund
     *
     * @param \AppBundle\Entity\ReservedFund $reservedFund
     *
     * @return Bid
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
     * Add chukoloFund
     *
     * @param \AppBundle\Entity\ChukoloFund $chukoloFund
     *
     * @return Bid
     */
    public function addChukoloFund(\AppBundle\Entity\ChukoloFund $chukoloFund)
    {
        $this->chukoloFund[] = $chukoloFund;

        return $this;
    }

    /**
     * Remove chukoloFund
     *
     * @param \AppBundle\Entity\ChukoloFund $chukoloFund
     */
    public function removeChukoloFund(\AppBundle\Entity\ChukoloFund $chukoloFund)
    {
        $this->chukoloFund->removeElement($chukoloFund);
    }

    /**
     * Get chukoloFund
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChukoloFund()
    {
        return $this->chukoloFund;
    }

    /**
     * Set saved
     *
     * @param integer $saved
     *
     * @return Bid
     */
    public function setSaved($saved)
    {
        $this->saved = $saved;

        return $this;
    }

    /**
     * Get saved
     *
     * @return integer
     */
    public function getSaved()
    {
        return $this->saved;
    }


    /**
     * Set awardExpireDate
     *
     * @param \DateTime $awardExpireDate
     *
     * @return Bid
     */
    public function setAwardExpireDate($awardExpireDate)
    {
        $this->awardExpireDate = $awardExpireDate;

        return $this;
    }

    /**
     * Get awardExpireDate
     *
     * @return \DateTime
     */
    public function getAwardExpireDate()
    {
        return $this->awardExpireDate;
    }

    /**
     * Set accepted
     *
     * @param integer $accepted
     *
     * @return Bid
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get accepted
     *
     * @return integer
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set started
     *
     * @param integer $started
     *
     * @return Bid
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return integer
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set acceptOffer
     *
     * @param integer $acceptOffer
     *
     * @return Bid
     */
    public function setAcceptOffer($acceptOffer)
    {
        $this->acceptOffer = $acceptOffer;

        return $this;
    }

    /**
     * Get acceptOffer
     *
     * @return integer
     */
    public function getAcceptOffer()
    {
        return $this->acceptOffer;
    }

    /**
     * @param mixed $milestoneProposal
     * @return Bid
     */
    public function setMilestoneProposal($milestoneProposal)
    {
        $this->milestoneProposal = $milestoneProposal;
        return $this;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Bid
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Add attachment
     *
     * @param \AppBundle\Entity\Attachment $attachment
     *
     * @return Bid
     */
    public function addAttachment(\AppBundle\Entity\Attachment $attachment)
    {
        $this->attachment[] = $attachment;
        return $this;
    }

    /**
     * Remove attachment
     *
     * @param \AppBundle\Entity\Attachment $attachment
     */
    public function removeAttachment(\AppBundle\Entity\Attachment $attachment)
    {
        $this->attachment->removeElement($attachment);
    }

    /**
     * Get attachment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set durationHour
     *
     * @param integer $durationHour
     *
     * @return Bid
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
     * @return Bid
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
     * @return Bid
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
     * Set moderated
     *
     * @param integer $moderated
     *
     * @return Bid
     */
    public function setModerated($moderated)
    {
        $this->moderated = $moderated;

        return $this;
    }

    /**
     * Get moderated
     *
     * @return integer
     */
    public function getModerated()
    {
        return $this->moderated;
    }

    /**
     * Set moderatorResponse
     *
     * @param string $moderatorResponse
     *
     * @return Bid
     */
    public function setModeratorResponse($moderatorResponse)
    {
        $this->moderatorResponse = $moderatorResponse;

        return $this;
    }

    /**
     * Get moderatorResponse
     *
     * @return string
     */
    public function getModeratorResponse()
    {
        return $this->moderatorResponse;
    }

    /**
     * Set moderatorMessage
     *
     * @param string $moderatorMessage
     *
     * @return Bid
     */
    public function setModeratorMessage($moderatorMessage)
    {
        $this->moderatorMessage = $moderatorMessage;

        return $this;
    }

    /**
     * Get moderatorMessage
     *
     * @return string
     */
    public function getModeratorMessage()
    {
        return $this->moderatorMessage;
    }
}
