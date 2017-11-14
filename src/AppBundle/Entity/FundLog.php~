<?php

namespace AppBundle\Entity;


use AppBundle\Model\TimeStampInterface;
use AppBundle\Model\TimeStampTrait;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fund_log")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FundLogRepository")
 */
class FundLog implements TimeStampInterface
{
  use TimeStampTrait;



    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(type="integer")
    */
    protected $amount;
    /**
     * @ORM\Column(type="text",options={"comment":"value:what the fund was used for example bid feature purchase, project upgrade  etc"})
     */
    protected $usedReason;
    /**
     * @ORM\Column(type="text",options={"comment":"value:what the fund was used for"})
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime",nullable=false)
     */
    protected $created;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="fundLog")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    protected $member;





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
     * @return FundLog
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
     * Set description
     *
     * @param string $description
     *
     * @return FundLog
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return FundLog
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
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return FundLog
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
     * Set usedReason
     *
     * @param string $usedReason
     *
     * @return FundLog
     */
    public function setUsedReason($usedReason)
    {
        $this->usedReason = $usedReason;

        return $this;
    }

    /**
     * Get usedReason
     *
     * @return string
     */
    public function getUsedReason()
    {
        return $this->usedReason;
    }
}
