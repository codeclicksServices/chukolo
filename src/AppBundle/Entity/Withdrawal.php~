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
 * @ORM\Table(name="withdrawal")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WithdrawalRepository")
 *  @Vich\Uploadable
 */
class Withdrawal
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
     * @ORM\Column(type="integer", length=50 ,nullable=false,options={"comment":"value:most time amount is equal to receive in case there is variation register"})
     */
    protected $received;
    /**
     * @ORM\Column(type="smallint",options={"comment":"value:if this withdrawal is complete the value would be removed from fund  it can be true or false"})
     * date created
     */
    protected $complete;
    /**
     * @ORM\Column(type="datetime",options={"comment":"value:date withdrawal was complete"})
     * date created
     */
    protected $complete_date;

    /**
     * @ORM\Column(type="string", length=20 ,nullable=false,options={"comment":"value: this can be either  processing release pending , withdrawn , ,declined "})
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=40 ,nullable=false,options={"comment":"value:in this case payer is chukolo"})
     */
    protected $payer;





    /*
     * this would have relationship with
     * 1 fund being withdrawn
     * 2 chukolos initiating banks
     * 3 the receiving bank(members registered outlet)
     * 4 an invoice is generated for for chukolo
     * 4  todo add this when is built (the staff that confirmed the payment or if it a script confirming payment this would be false)
     *  */

    /**
     * @ORM\ManyToOne(targetEntity="Fund", inversedBy="withdrawal")
     * @ORM\JoinColumn(name="fund_id",referencedColumnName="id", nullable=false )
     */
    protected $fund;
    /**
     * payer here is the initiating bank
     * @ORM\ManyToOne(targetEntity="ChukoloBank", inversedBy="withdrawal")
     * @ORM\JoinColumn(name="initiatingBank_id",referencedColumnName="id", nullable=false )
     */
    protected $initiatingBank;


    /**
     * payer here is the member receiving bank
     * @ORM\ManyToOne(targetEntity="MemberBank", inversedBy="withdrawal")
     * @ORM\JoinColumn(name="receivingBank_id",referencedColumnName="id", nullable=false )
     */
    protected $receivingBank;
    /**
     * @ORM\OneToOne(targetEntity="ChukoloInvoice", mappedBy="withdrawal")
     */
    protected $chukoloInvoice;

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
     * @return Withdrawal
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
     * Set received
     *
     * @param integer $received
     *
     * @return Withdrawal
     */
    public function setReceived($received)
    {
        $this->received = $received;

        return $this;
    }

    /**
     * Get received
     *
     * @return integer
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set complete
     *
     * @param integer $complete
     *
     * @return Withdrawal
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
     * Set completeDate
     *
     * @param \DateTime $completeDate
     *
     * @return Withdrawal
     */
    public function setCompleteDate($completeDate)
    {
        $this->complete_date = $completeDate;

        return $this;
    }

    /**
     * Get completeDate
     *
     * @return \DateTime
     */
    public function getCompleteDate()
    {
        return $this->complete_date;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Withdrawal
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
     * @return Withdrawal
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
     * Set fund
     *
     * @param \AppBundle\Entity\Fund $fund
     *
     * @return Withdrawal
     */
    public function setFund(\AppBundle\Entity\Fund $fund)
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
     * Set initiatingBank
     *
     * @param \AppBundle\Entity\ChukoloBank $initiatingBank
     *
     * @return Withdrawal
     */
    public function setInitiatingBank(\AppBundle\Entity\ChukoloBank $initiatingBank)
    {
        $this->initiatingBank = $initiatingBank;

        return $this;
    }

    /**
     * Get initiatingBank
     *
     * @return \AppBundle\Entity\ChukoloBank
     */
    public function getInitiatingBank()
    {
        return $this->initiatingBank;
    }

    /**
     * Set receivingBank
     *
     * @param \AppBundle\Entity\MemberBank $receivingBank
     *
     * @return Withdrawal
     */
    public function setReceivingBank(\AppBundle\Entity\MemberBank $receivingBank)
    {
        $this->receivingBank = $receivingBank;

        return $this;
    }

    /**
     * Get receivingBank
     *
     * @return \AppBundle\Entity\MemberBank
     */
    public function getReceivingBank()
    {
        return $this->receivingBank;
    }

    /**
     * Set invoice
     *
     * @param \AppBundle\Entity\ChukoloInvoice $invoice
     *
     * @return Withdrawal
     */
    public function setInvoice(\AppBundle\Entity\ChukoloInvoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \AppBundle\Entity\ChukoloInvoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set chukoloInvoice
     *
     * @param \AppBundle\Entity\ChukoloInvoice $chukoloInvoice
     *
     * @return Withdrawal
     */
    public function setChukoloInvoice(\AppBundle\Entity\ChukoloInvoice $chukoloInvoice = null)
    {
        $this->chukoloInvoice = $chukoloInvoice;

        return $this;
    }

    /**
     * Get chukoloInvoice
     *
     * @return \AppBundle\Entity\ChukoloInvoice
     */
    public function getChukoloInvoice()
    {
        return $this->chukoloInvoice;
    }
}
