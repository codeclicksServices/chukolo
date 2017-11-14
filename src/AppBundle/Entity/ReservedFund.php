<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="reserved_fund")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservedFundRepository")
 *  @Vich\Uploadable
 */
class  ReservedFund
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     *@ORM\Column(type = "string", nullable=false, options={"comment":" Amount paid"})
     *@Assert\NotBlank()
     */
    protected $amount;
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"mode of payment"})
     */
    protected $description;

    /**
     * todo: 1 = milestone Payment, 2 = project upgrade and 3= bid upgrade
     * @ORM\Column(type="text", nullable=false, options={"comment":"why is this fund reserved ? eg 1 =milestone Payment, 2 = project upgrade and 3 = bid upgrade"})
     */
    protected $source;
    /**
     * @ORM\Column(type="text", nullable=false, options={"comment":"deleted awaiting processing or completed"})
     */
    protected $status;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;


    /**
     *owner of the reservation
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="reservedFund")
     * @ORM\JoinColumn(name="member_id",referencedColumnName="id", nullable=false )
     */
    protected $member;

    /**
     * @ORM\ManyToOne(targetEntity="Milestone", inversedBy="reservedFund",cascade={"persist"})
     * @ORM\JoinColumn(name="milestone_id", referencedColumnName="id", nullable=true)
     */
    private $milestone;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="reservedFund",cascade={"persist"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=true)
     */
    private $project;

    /**
     *this should be one to manny
     * @ORM\ManyToOne(targetEntity="Bid", inversedBy="reservedFund",cascade={"persist"})
     * @ORM\JoinColumn(name="bid_id", referencedColumnName="id", nullable=true)
     */
    private $bid;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Subscription", inversedBy="reservedFund",cascade={"persist"})
     * @ORM\JoinColumn(name="subscription_id", referencedColumnName="id", nullable=true)
     */
    private $subscription;

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
     * @param string $amount
     *
     * @return ReservedFund
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get amount
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set description
     * @param string $description
     * @return ReservedFund
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
     * Set source
     *
     * @param string $source
     *
     * @return ReservedFund
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return ReservedFund
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ReservedFund
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
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return ReservedFund
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
     * Set bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return ReservedFund
     */
    public function setBid(\AppBundle\Entity\Bid $bid = null)
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
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return ReservedFund
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
     * Set milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     *
     * @return ReservedFund
     */
    public function setMilestone(\AppBundle\Entity\Milestone $milestone = null)
    {
        $this->milestone = $milestone;

        return $this;
    }

    /**
     * Get milestone
     *
     * @return \AppBundle\Entity\Milestone
     */
    public function getMilestone()
    {
        return $this->milestone;
    }

    /**
     * Set subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     *
     * @return ReservedFund
     */
    public function setSubscription(\AppBundle\Entity\Subscription $subscription = null)
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Get subscription
     *
     * @return \AppBundle\Entity\Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }
}
