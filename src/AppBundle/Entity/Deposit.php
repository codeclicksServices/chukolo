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
     * 1 the receiving bank
     * 2 the member making payment
     * 3 fund
     * 4 the staff that confirmed the payment or if it a script confirming payment this would be false */


}