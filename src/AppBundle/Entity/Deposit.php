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
 * @ORM\Table(name="deposits")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepositRepository")
 *  @Vich\Uploadable
 */
class Deposit
{
    /**
     * once payment is mad to chukolo it comes here once its confirmed it can then be used
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="integer", length=50 ,nullable=false,options={"comment":"value: actual amount paid to chukolo account "})
     */
    protected $amount;

    /**
     * @ORM\Column(type="string",nullable=false, length =30,options={"comment":"value: unique transaction id for bank deposit its the teller number "})
     */
    protected $transactionId;

    /**
     * @ORM\Column(type="string", length=20 ,nullable=false,options={"comment":"value: i.e bank deposit online transfer, credit card payment"})
     */
    protected $method;

    /**
     * @ORM\Column(type="smallint",options={"comment":"value:if this deposit is confirmed an converted to member fund it can be true or false"})
     * date created
     */
    protected $confirmed;
    /**
     * @ORM\Column(type="datetime",options={"comment":"value:date confirmed"})
     * date created
     */
    protected $confirmed_date;

    /**
     * @ORM\Column(type="string", length=20 ,nullable=false,options={"comment":"value: this can be either pending , confirmed, investigating,false"})
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=40 ,nullable=false,options={"comment":"value: this is the name of the person making the payment it musn't be a member"})
     */
    protected $payer;

    /**
     * @ORM\Column(type="string", length=40 ,nullable=false,options={"comment":"value:this is the bank that the payment is made from eg zenith "})
     */
    protected $initiatingBank;

    /**
     * @Vich\UploadableField(mapping="deposit_file", fileNameProperty="documentName")
     *
     * @var File
     */
    private $depositFile;

    /**
     * if their is a document
     * @ORM\Column(type="string", nullable=true,length=255)
     *
     * @var string
     */
    private $documentName;


    /*
     * this would have relationship with
     * 1 the receiving bank(I.E chukolo receivin banks
     * 2 the member making payment
     * 3 fund
     *  todo add this when is built (the staff that confirmed the payment or if it a script confirming payment this would be false)
     * */

    /*
     * relationships
     * Definition of relationship
     * deposit came from me to a receiver for chukolo as my fund in chukolo
     * so payer is member receiver is member fund in chukolo
     */

    /**
     * many deposits belong to one member
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="deposit")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

    /**
     * many deposits belong to one chukolo account and receiver in
     * this case is a chukolo account
     * @ORM\ManyToOne(targetEntity="ChukoloBank", inversedBy="deposit")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
     */
    private $receiver;

    /**
     * @ORM\ManyToOne(targetEntity="Fund", inversedBy="deposit")
     * @ORM\JoinColumn(name="fund_id", referencedColumnName="id")
     */
    private $fund;


    /**
     * @ORM\OneToOne(targetEntity="Invoice", mappedBy="deposit")
     */
    private $invoice;

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
     * @return Deposit
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
     * Set transactionId
     *
     * @param string $transactionId
     *
     * @return Deposit
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return Deposit
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set confirmed
     *
     * @param integer $confirmed
     *
     * @return Deposit
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return integer
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set confirmedDate
     *
     * @param \DateTime $confirmedDate
     *
     * @return Deposit
     */
    public function setConfirmedDate($confirmedDate)
    {
        $this->confirmed_date = $confirmedDate;

        return $this;
    }

    /**
     * Get confirmedDate
     *
     * @return \DateTime
     */
    public function getConfirmedDate()
    {
        return $this->confirmed_date;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Deposit
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
     * Set payer
     *
     * @param string $payer
     *
     * @return Deposit
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer
     *
     * @return string
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set initiatingBank
     *
     * @param string $initiatingBank
     *
     * @return Deposit
     */
    public function setInitiatingBank($initiatingBank)
    {
        $this->initiatingBank = $initiatingBank;

        return $this;
    }

    /**
     * Get initiatingBank
     *
     * @return string
     */
    public function getInitiatingBank()
    {
        return $this->initiatingBank;
    }

    /**
     * Set documentName
     *
     * @param string $documentName
     *
     * @return Deposit
     */
    public function setDocumentName($documentName)
    {
        $this->documentName = $documentName;

        return $this;
    }

    /**
     * Get documentName
     *
     * @return string
     */
    public function getDocumentName()
    {
        return $this->documentName;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Deposit
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
     * Set receiver
     *
     * @param \AppBundle\Entity\ChukoloBank $receiver
     *
     * @return Deposit
     */
    public function setReceiver(\AppBundle\Entity\ChukoloBank $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \AppBundle\Entity\ChukoloBank
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set fund
     *
     * @param \AppBundle\Entity\Fund $fund
     *
     * @return Deposit
     */
    public function setFund(\AppBundle\Entity\Fund $fund = null)
    {
        $this->fund = $fund;

        return $this;
    }

    /**
     * Get fund
     *
     * @return \AppBundle\Entity\Fund
     */
    public function getFund()
    {
        return $this->fund;
    }

    /**
     * Set invoice
     *
     * @param \AppBundle\Entity\Invoice $invoice
     *
     * @return Deposit
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
}
