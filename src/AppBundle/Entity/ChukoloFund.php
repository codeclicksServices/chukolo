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
 * @ORM\Table(name="chukolo_funds")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChukoloFundRepository")
 *  @Vich\Uploadable
 *
 * this is the table that holds the amount chukolo has made from bid project commission membership etc
 */
class  ChukoloFund
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false,
     *   options={"comment":"fund value i.e this amount is equal to the $reserved + usableAmount + paidOutAmount"})
     */
    protected $amount;

    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"mode of payment"})
     */
    protected $description;

    /**
     * @ORM\Column(type="text", nullable=false,
     *     options={"comment":"where is the money coming from eg bid_commission, project_upgrade, bid_upgrade, membership "})
     */
    protected $source;

    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"the currency is  ngn for now"})
     */
    protected $currency;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;




    /**
     *owner of the reservation
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="chukoloFund")
     * @ORM\JoinColumn(name="payer_id",referencedColumnName="id", nullable=false )
     */
    protected $payer;

    /**
     * todo this is the bid that the commission is earned from
     * this case because commission is collected from the bid it makes sense to know the source
     * @ORM\ManyToOne(targetEntity="Bid", inversedBy="chukoloFund",cascade={"persist"})
     * @ORM\JoinColumn(name="bid_id", referencedColumnName="id", nullable=true)
     */
    private $bid;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Subscription", inversedBy="chukoloFund",cascade={"persist"})
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
     * @return ChukoloFund
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
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
     * @return ChukoloFund
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
     * @return ChukoloFund
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
     * Set currency
     *
     * @param string $currency
     *
     * @return ChukoloFund
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ChukoloFund
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
     * Set payer
     *
     * @param \AppBundle\Entity\Member $payer
     *
     * @return ChukoloFund
     */
    public function setPayer(\AppBundle\Entity\Member $payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer
     *
     * @return \AppBundle\Entity\Member
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return ChukoloFund
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
     * Set subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     *
     * @return ChukoloFund
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
