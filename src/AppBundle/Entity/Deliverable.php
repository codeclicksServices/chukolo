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
 * this is the tasks to be completed
 * @ORM\Entity
 * @ORM\Table(name="deliverable")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeliverableRepository")
 */
class Deliverable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, options={"comment":"The name of this task"}))
     */
    private $task;
    /**
     * @ORM\Column(type="string", length=80,options={"comment":"value: pending,working,paused,awaiting-reviewed,complete"})
     */
    private $status;
    /**
     * @ORM\Column(type="string", length=80,options={"comment":"value: completion point that is  0 to max point"})
     */
    private $point;
    /**
     * @ORM\Column(type="text",options={"comment":"The freelancer note or comment on this task example explaining the processes of the task or any challenge he face"} )
     */
    private $note;

    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"The freelancer marks this task as done"})
     */
    protected $done;

    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"employer accepted this task"})
     */
    protected $accept;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"employer declined this for a redo"})
     */
    protected $decline;
    /**
     * @ORM\Column(type="smallint",options={ "default":0,"comment":"checks weather this deliverable has been reviewed by the employer"})
     */
    protected $reviewed;

    /**
     * @ORM\Column(type="string",nullable=true, length=100,options={"comment":"the feedback for this review"})
     */
    protected $reviewedMessage;


    /*relationships*/

    /**
     * @ORM\ManyToOne(targetEntity="MilestoneProposal", inversedBy="deliverable")
     * @ORM\JoinColumn(name="milestoneProposal_id", referencedColumnName="id",nullable=true)
     */
    protected $milestoneProposal;




    /**
     * @ORM\ManyToOne(targetEntity="Milestone", inversedBy="deliverable")
     * @ORM\JoinColumn(name="milestone_id", referencedColumnName="id")
     */
    protected $milestone;



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
     * Set task
     *
     * @param integer $task
     *
     * @return Deliverable
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return integer
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Deliverable
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set done
     *
     * @param integer $done
     *
     * @return Deliverable
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return integer
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set accept
     *
     * @param integer $accept
     *
     * @return Deliverable
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;

        return $this;
    }

    /**
     * Get accept
     *
     * @return integer
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * Set decline
     *
     * @param integer $decline
     *
     * @return Deliverable
     */
    public function setDecline($decline)
    {
        $this->decline = $decline;

        return $this;
    }

    /**
     * Get decline
     *
     * @return integer
     */
    public function getDecline()
    {
        return $this->decline;
    }

    /**
     * Set milestoneProposal
     *
     * @param \AppBundle\Entity\MilestoneProposal $milestoneProposal
     *
     * @return Deliverable
     */
    public function setMilestoneProposal(\AppBundle\Entity\MilestoneProposal $milestoneProposal = null)
    {
        $this->milestoneProposal = $milestoneProposal;

        return $this;
    }

    /**
     * Get milestoneProposal
     *
     * @return \AppBundle\Entity\MilestoneProposal
     */
    public function getMilestoneProposal()
    {
        return $this->milestoneProposal;
    }



    /**
     * Set milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     *
     * @return Deliverable
     */
    public function setMilestone(\AppBundle\Entity\Milestone $milestone = null)
    {
        $this->milestone = $milestone;

        return $this;
    }

    /**
     * Get milestone
     *
     * @return \AppBundle\Entity\Milestone
     */
    public function getMilestone()
    {
        return $this->milestone;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Deliverable
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
     * Set reviewed
     *
     * @param integer $reviewed
     *
     * @return Deliverable
     */
    public function setReviewed($reviewed)
    {
        $this->reviewed = $reviewed;

        return $this;
    }

    /**
     * Get reviewed
     *
     * @return integer
     */
    public function getReviewed()
    {
        return $this->reviewed;
    }

    /**
     * Set reviewedMessage
     *
     * @param string $reviewedMessage
     *
     * @return Deliverable
     */
    public function setReviewedMessage($reviewedMessage)
    {
        $this->reviewedMessage = $reviewedMessage;

        return $this;
    }

    /**
     * Get reviewedMessage
     *
     * @return string
     */
    public function getReviewedMessage()
    {
        return $this->reviewedMessage;
    }

    /**
     * Set point
     *
     * @param string $point
     *
     * @return Deliverable
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Get point
     *
     * @return string
     */
    public function getPoint()
    {
        return $this->point;
    }
}
