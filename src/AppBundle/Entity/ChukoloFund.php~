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
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="source", type="string")
 * @ORM\DiscriminatorMap({"project-commission" = "AppBundle\Entity\ProjectCommissionFund","sponsorship" = "AppBundle\Entity\SponsorshipFund", "bid-subscription" = "AppBundle\Entity\BidSubscriptionFund", "project-subscription" = "AppBundle\Entity\ProjectSubscriptionFund", "membership" = "AppBundle\Entity\MembershipFund"})
 *
 * this is the table that holds the amount chukolo has made from bid project commission membership etc
 */
abstract class  ChukoloFund
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
     * @ORM\Column(type="string", nullable=false, options={"comment":"what is the source of the payment "})
     */
    protected $description;

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
}
