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
 * @ORM\Table(name="funds")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FundRepository")
 *  @Vich\Uploadable
 *
 * confirmed money in your chukolo account its source is either milestone received for a job don or your deposit
 */
class  Fund
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer, nullable=false, options={"comment":"fund value i.e this amount is equal to the $reserved + usableAmount + paidOutAmount})
     *
     */
    protected $amount;

    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"this is the amount reserved that you cannot withdraw or use its either saved up for milestone suscription or about to be withdrawn"})
     */
    protected $reserved;

    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"amount not reserved it can be used for everything on chukolo i.e ur balance "})
     */
    protected $usableAmount;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"this is the reservation amount you paid "})
     */
    protected $paidOutAmount;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"this is the reservation amount + usable amount "})
     */
    protected $bookBalance;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"the currency is  ngn for now"})
     */
    protected $currency;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"where the fund came from is it deposit or job payment "})
     */
    protected $source;
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"received value i.e the amount deposited or received from doing a project "})
     * is going to be paid from the source that ph
     */
    protected $received;

    /**
     * @ORM\Column(type="string", nullable=false,
     *options={"comment":" later","default":"created"})
     *
     */
    protected $status;
    /**
     * @ORM\Column(type="smallint",nullable=true, options={"unsigned":false,"comment":"this would be closed wen the money is either fully reserved or used up" ,"default":0})
     */
    protected $closeUsage;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned":false, "default":0})
     */
    protected $complete;

    /**
     * @ORM\Column(type="smallint",nullable=true, options={"unsigned":false,"comment":"this is used for either enabling or disabling the withdrawal of this fund " , "default":0})
     */
    protected $payout;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * when the ph was completed
     */
    protected $completedAt;




    /*
     * relationships
     * 1 who owns
     * 2 source where the money came from i .e deposit id
     * outlet is withdrawal id
     * invoice
     *
     */



}
