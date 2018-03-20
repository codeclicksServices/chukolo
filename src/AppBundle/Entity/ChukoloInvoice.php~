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
 * @ORM\Table(name="chukolo_invoice")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 *  @Vich\Uploadable
 */
class  ChukoloInvoice
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
     * @ORM\Column(type="string", nullable=false, options={"comment":"i.e default is ngn"})
     */
    protected $currency;
    /**
     * @ORM\Column(type="text", nullable=false, options={"comment":"who owns the source of payment "})
     */
    protected $payer;

    /**
     * @ORM\Column(type="text", nullable=false, options={"comment":"I.e what is this invoice generated for eg deposit milestone payment subscription "})
     */
    protected $source;
    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    protected $status;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;


    /*
     * For anytime chukolo pay out money an invoice is generated for chukolo
     */
    /**
     * one source of fund
     * @ORM\OneToOne(targetEntity="Withdrawal", inversedBy="chukoloInvoice")
     * @ORM\JoinColumn(name="withdrawal_id", referencedColumnName="id", nullable=false)
     */
    private $withdrawal;


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
     * @return ChukoloInvoice
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
     * @return ChukoloInvoice
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
     * @return ChukoloInvoice
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
     * Set payer
     *
     * @param string $payer
     *
     * @return ChukoloInvoice
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
     * Set source
     *
     * @param string $source
     *
     * @return ChukoloInvoice
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
     * @param integer $status
     *
     * @return ChukoloInvoice
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
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
     * @return ChukoloInvoice
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
     * Set withdrawal
     *
     * @param \AppBundle\Entity\Withdrawal $withdrawal
     *
     * @return ChukoloInvoice
     */
    public function setWithdrawal(\AppBundle\Entity\Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;

        return $this;
    }

    /**
     * Get withdrawal
     *
     * @return \AppBundle\Entity\Withdrawal
     */
    public function getWithdrawal()
    {
        return $this->withdrawal;
    }
}
