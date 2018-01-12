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
 * comments
 * @ORM\Entity
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;




    /*rships*/
    /*
     * @ORM\ManyToOne(targetEntity="Deliverable", inversedBy="comment")
     * @ORM\JoinColumn(name="deliverable_id",referencedColumnName="id", nullable=true )
     */
    protected $deliverable;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="comment")
     * @ORM\JoinColumn(name="sender_id",referencedColumnName="id", nullable=false )
     */
    protected $sender;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="comment")
     * @ORM\JoinColumn(name="receiver_id",referencedColumnName="id", nullable=false )
     */
    protected $receiver;

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
     * Set message
     *
     * @param string $message
     *
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set sender
     *
     * @param \AppBundle\Entity\Member $sender
     *
     * @return Comment
     */
    public function setSender(\AppBundle\Entity\Member $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \AppBundle\Entity\Member
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param \AppBundle\Entity\Member $receiver
     *
     * @return Comment
     */
    public function setReceiver(\AppBundle\Entity\Member $receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \AppBundle\Entity\Member
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
