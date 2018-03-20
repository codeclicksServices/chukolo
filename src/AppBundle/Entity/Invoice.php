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
*  @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"contract-invoice" = "AppBundle\Entity\ContractInvoice"})
 */
abstract class  Invoice
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     *@ORM\Column(type = "string", nullable=false, options={"comment":" total amount for this invoice "})
     *@Assert\NotBlank()
     */
    protected $total;
    /**
     *@ORM\Column(type = "string", nullable=false, options={"comment":"amount paid"})
     *@Assert\NotBlank()
     */
    protected $paid;
    /**
     *@ORM\Column(type = "string", nullable=false, options={"comment":"remaining balance"})
     *@Assert\NotBlank()
     */
    protected $balance;

    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"i.e default is ngn"})
     */
    protected $currency;
    /**
     * @ORM\Column(type="text", nullable=false, options={"comment":"who owns the source of payment "})
     */
    protected $payer;
    /**
     * @ORM\Column(type="text", nullable=false, options={"comment":"person receiving this fund "})
     */
    protected $receiver;
    /**
     * @ORM\Column(type="string", nullable=false,options={"comment":"I.e pending, due,paid  "})
     */
    protected $status;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;





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
     * Set total
     *
     * @param string $total
     *
     * @return Invoice
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set paid
     *
     * @param string $paid
     *
     * @return Invoice
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return string
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return Invoice
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
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
     * Set receiver
     *
     * @param string $receiver
     *
     * @return Invoice
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return string
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set status
     *
     * @param string $status
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
}
