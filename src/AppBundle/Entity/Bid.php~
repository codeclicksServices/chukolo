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
     * @ORM\Column(type="integer",options={"comment":"value: bid price + commission which will be debited from the employer " })
     */
    protected $value;
    /**
     * @ORM\Column(type="string", length=30,options={"comment":"current state of the bid"})
     */
    protected $state;
    /**
     * @ORM\Column(type="smallint")
     */
    protected $visible;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    protected $deliveryDate;

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
}
