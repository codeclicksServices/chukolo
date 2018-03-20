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
 * @ORM\Table(name="chukolo_fund_log")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChukoloFundLogRepository")
 */
class ChukoloFundLog implements TimeStampInterface
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
    protected $reason;
    /**
     * @ORM\Column(type="text",options={"comment":"value:what the fund was used for"})
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime",nullable=false)
     */
    protected $created;

    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"fund coming in "})
     */
    protected $inflow;




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
     * @return ChukoloFundLog
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
     * Set reason
     *
     * @param string $reason
     *
     * @return ChukoloFundLog
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ChukoloFundLog
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
     * @return ChukoloFundLog
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
     * Set inflow
     *
     * @param integer $inflow
     *
     * @return ChukoloFundLog
     */
    public function setInflow($inflow)
    {
        $this->inflow = $inflow;

        return $this;
    }

    /**
     * Get inflow
     *
     * @return integer
     */
    public function getInflow()
    {
        return $this->inflow;
    }
}
