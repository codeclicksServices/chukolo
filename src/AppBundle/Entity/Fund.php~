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
 * money you can use
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
     * @ORM\Column(type="string", nullable=false,
     *   options={"comment":"fund value i.e this amount is equal to the reserved + usableAmount + paidOutAmount"})
     */
    protected $amount;

    /**
     * @ORM\Column(type="string", nullable=false,
     *   options={"comment":"this is the amount reserved that you cannot withdraw or use its either saved up for milestone subscription or about to be withdrawn"})
     */
    protected $reserved;

    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"amount not reserved it can be used for everything on chukolo i.e ur balance "})
     */
    protected $usableAmount;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"this is the total withdrawn made from chukolo"})
     */
    protected $withdrawn;
    /**
     * @ORM\Column(type="integer", nullable=true, options={"comment":"this is the value for your bid upgrades "})
     */
    protected $bidUpgrade;
    /**
     * @ORM\Column(type="integer", nullable=true, options={"comment":"this is the value for your project upgrades "})
     */
    protected $projectUpgrade;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"this is the amount you spend on project"})
     */
    protected $projectPayment;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"this is the reservation amount + usable amount "})
     */
    protected $bookBalance;
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"the currency is  ngn for now"})
     */
    protected $currency;

    /**
     * @ORM\Column(type="string", nullable=true, options={"comment":"received value i.e the amount deposited or received from doing a project "})
     *
     */
    protected $received;

    /**
     * @ORM\Column(type="string", nullable=false,
     *options={"comment":" later","default":"created"})
     *
     */
    protected $status;
    /**
     * @ORM\Column(type="smallint",nullable=true, options={"unsigned":false,"comment":"this would be closed when the money is either fully reserved or used up" ,"default":0})
     */
    protected $closeUsage;


    /**
     * @ORM\Column(type="smallint",nullable=true, options={"unsigned":false,"comment":"this is used for either enabling or disabling the withdrawal of this fund " , "default":0})
     */
    protected $payout;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;





    /*
     * relationships
     * 1 who owns no need for direct relationship cus it came from a source
     * 2 source where the money came from i .e deposit id or milestone id
     * outlet is withdrawal id
     * invoice
     *
     */

    /**
     *member that owns the fund
     * @ORM\OneToOne(targetEntity="Member", inversedBy="fund",cascade={"persist"})
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false)
     */
    private $owner;

    /**
     *  @ORM\OneToMany(targetEntity="Milestone", mappedBy="fund")
     */
    private $milestone;


    /**
     *  @ORM\OneToMany(targetEntity="Withdrawal", mappedBy="fund")
     */
    protected $withdrawal;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->withdrawal = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Fund
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
     * Set reserved
     *
     * @param string $reserved
     *
     * @return Fund
     */
    public function setReserved($reserved)
    {
        $this->reserved = $reserved;

        return $this;
    }

    /**
     * Get reserved
     *
     * @return string
     */
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * Set usableAmount
     *
     * @param string $usableAmount
     *
     * @return Fund
     */
    public function setUsableAmount($usableAmount)
    {
        $this->usableAmount = $usableAmount;

        return $this;
    }

    /**
     * Get usableAmount
     *
     * @return string
     */
    public function getUsableAmount()
    {
        return $this->usableAmount;
    }



    /**
     * Set bookBalance
     *
     * @param string $bookBalance
     *
     * @return Fund
     */
    public function setBookBalance($bookBalance)
    {
        $this->bookBalance = $bookBalance;

        return $this;
    }

    /**
     * Get bookBalance
     *
     * @return string
     */
    public function getBookBalance()
    {
        return $this->bookBalance;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Fund
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
     * Set received
     *
     * @param string $received
     *
     * @return Fund
     */
    public function setReceived($received)
    {
        $this->received = $received;

        return $this;
    }

    /**
     * Get received
     *
     * @return string
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Fund
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
     * Set closeUsage
     *
     * @param integer $closeUsage
     *
     * @return Fund
     */
    public function setCloseUsage($closeUsage)
    {
        $this->closeUsage = $closeUsage;

        return $this;
    }

    /**
     * Get closeUsage
     *
     * @return integer
     */
    public function getCloseUsage()
    {
        return $this->closeUsage;
    }

    /**
     * Set payout
     *
     * @param integer $payout
     *
     * @return Fund
     */
    public function setPayout($payout)
    {
        $this->payout = $payout;

        return $this;
    }

    /**
     * Get payout
     *
     * @return integer
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Fund
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
     * Set owner
     *
     * @param \AppBundle\Entity\Member $owner
     *
     * @return Fund
     */
    public function setOwner(\AppBundle\Entity\Member $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\Member
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     *
     * @return Fund
     */
    public function addMilestone(\AppBundle\Entity\Milestone $milestone)
    {
        $this->milestone[] = $milestone;

        return $this;
    }

    /**
     * Remove milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     */
    public function removeMilestone(\AppBundle\Entity\Milestone $milestone)
    {
        $this->milestone->removeElement($milestone);
    }

    /**
     * Get milestone
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMilestone()
    {
        return $this->milestone;
    }

    /**
     * Add deposit
     *
     * @param \AppBundle\Entity\Deposit $deposit
     *
     * @return Fund
     */
    public function addDeposit(\AppBundle\Entity\Deposit $deposit)
    {
        $this->deposit[] = $deposit;

        return $this;
    }

    /**
     * Remove deposit
     *
     * @param \AppBundle\Entity\Deposit $deposit
     */
    public function removeDeposit(\AppBundle\Entity\Deposit $deposit)
    {
        $this->deposit->removeElement($deposit);
    }

    /**
     * Get deposit
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeposit()
    {
        return $this->deposit;
    }

    /**
     * Add withdrawal
     *
     * @param \AppBundle\Entity\Withdrawal $withdrawal
     *
     * @return Fund
     */
    public function addWithdrawal(\AppBundle\Entity\Withdrawal $withdrawal)
    {
        $this->withdrawal[] = $withdrawal;

        return $this;
    }

    /**
     * Remove withdrawal
     *
     * @param \AppBundle\Entity\Withdrawal $withdrawal
     */
    public function removeWithdrawal(\AppBundle\Entity\Withdrawal $withdrawal)
    {
        $this->withdrawal->removeElement($withdrawal);
    }

    /**
     * Get withdrawal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWithdrawal()
    {
        return $this->withdrawal;
    }

    /**
     * Set withdrawn
     *
     * @param string $withdrawn
     *
     * @return Fund
     */
    public function setWithdrawn($withdrawn)
    {
        $this->withdrawn = $withdrawn;

        return $this;
    }

    /**
     * Get withdrawn
     *
     * @return string
     */
    public function getWithdrawn()
    {
        return $this->withdrawn;
    }

    /**
     * Set bidUpgrade
     *
     * @param string $bidUpgrade
     *
     * @return Fund
     */
    public function setBidUpgrade($bidUpgrade)
    {
        $this->bidUpgrade = $bidUpgrade;

        return $this;
    }

    /**
     * Get bidUpgrade
     *
     * @return string
     */
    public function getBidUpgrade()
    {
        return $this->bidUpgrade;
    }

    /**
     * Set projectUpgrade
     *
     * @param integer $projectUpgrade
     *
     * @return Fund
     */
    public function setProjectUpgrade($projectUpgrade)
    {
        $this->projectUpgrade = $projectUpgrade;

        return $this;
    }

    /**
     * Get projectUpgrade
     *
     * @return integer
     */
    public function getProjectUpgrade()
    {
        return $this->projectUpgrade;
    }

    /**
     * Set projectPayment
     *
     * @param string $projectPayment
     *
     * @return Fund
     */
    public function setProjectPayment($projectPayment)
    {
        $this->projectPayment = $projectPayment;

        return $this;
    }

    /**
     * Get projectPayment
     *
     * @return string
     */
    public function getProjectPayment()
    {
        return $this->projectPayment;
    }
}
