<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="milestone_proposals")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MilestoneProposalsRepository")
 */
class MilestoneProposal
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=80)
     */
    private $amount;
    /**
     * @ORM\Column(type="string", length=80)
     */
    private $description;
    /**
     * @ORM\Column(type="text",options={"default":0,"comment":"value: is 0 and 1(proposal or offer)  the freelancer propose and the employer offers"})
     */
    private $type;

      /*
       * relationship
       * milestone for a who through what contract which is the fund
       * by  member
       * for project
       */

    /**
     * contract is the same thing as bid after is awarded
     * @ORM\ManyToOne(targetEntity="Bid", inversedBy="milestone")
     * @ORM\JoinColumn(name="bid_id",referencedColumnName="id" ,nullable=false)
     */
    protected $bid;





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
     * @return MilestoneProposal
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
     * @return MilestoneProposal
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
     * Set type
     *
     * @param string $type
     *
     * @return MilestoneProposal
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return MilestoneProposal
     */
    public function setBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get bid
     *
     * @return \AppBundle\Entity\Bid
     */
    public function getBid()
    {
        return $this->bid;
    }
}
