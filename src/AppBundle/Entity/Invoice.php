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
 * @ORM\Table(name="invoice")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InvoiceRepository")
 *  @Vich\Uploadable
 */
class  Invoice
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
     * @ORM\Column(type="text", nullable=false, options={"comment":"I.e what is this invoice generated for eg deposit milestone payment suscription "})
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
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="pop_file", fileNameProperty="popName")
     *
     * @var File
     */
    private $popFile;

    /**
     * @ORM\Column(type="string", nullable=true,length=255)
     *
     * @var string
     */
    private $popName;



    /*
     * this has a relatioship with the deposit
     */
    /*
     * one source of fund
     * @ORM\OneToOne(targetEntity="Deposit", inversedBy="invoice")
     * @ORM\JoinColumn(name="deposit_id", referencedColumnName="id", nullable=true)
     */
    private $deposit;

       /*
        * one source of fund
        * @ORM\OneToOne(targetEntity="Milestone", inversedBy="invoice")
        * @ORM\JoinColumn(name="milestone_id", referencedColumnName="id", nullable=true)
        */
        private $milestone;


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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * Set popName
     *
     * @param string $popName
     *
     * @return Invoice
     */
    public function setPopName($popName)
    {
        $this->popName = $popName;

        return $this;
    }

    /**
     * Get popName
     *
     * @return string
     */
    public function getPopName()
    {
        return $this->popName;
    }
}
