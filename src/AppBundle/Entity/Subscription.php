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
 * @ORM\Table(name="subscription")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriptionRepository")
 *  @Vich\Uploadable
 */
class Subscription
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="smallint", nullable=false,options={"comment":"value: 1 for project i.e is used as employer, 2 for bid used by freelancer  "})
     */
    protected $type;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $description;
    /**
     * @ORM\Column(type="smallint", length=1)
     */
    protected $enabled;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $note;
    /**

    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: this is the cost of purchasing this features "})
     *
     */
    private $value;

    /**
     *
     * @Vich\UploadableField(mapping="suscription_file", fileNameProperty="bannerName")
     *
     * @var File
     */
    private $bannerFile;

    /**
     * @ORM\Column(type="string", nullable=true,length=255)
     *
     * @var string
     */
    private $bannerName;




    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="subscription")
     */
    private $project;

    /**
     * @ORM\ManyToMany(targetEntity="Bid", mappedBy="subscription")
     */
    private $bid;

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
     * Set name
     *
     * @param string $name
     *
     * @return Subscription
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Subscription
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
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $banner
     *
     * @return Project
     */
    public function setBannerFile(File $banner = null)
    {
        $this->bannerFile = $banner;

        if ($banner) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getBannerFile()
    {
        return $this->bannerFile;
    }

    /**
     * @param string $bannerName
     *
     * @return Project
     */
    public function setBannerName($bannerName)
    {
        $this->bannerName = $bannerName;

        return $this;
    }





    /**
     * Set value
     *
     * @param integer $value
     *
     * @return Subscription
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get bannerName
     *
     * @return string
     */
    public function getBannerName()
    {
        return $this->bannerName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->project = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Subscription
     */
    public function addProject(\AppBundle\Entity\Project $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\Project $project
     */
    public function removeProject(\AppBundle\Entity\Project $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Get project
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return Subscription
     */
    public function addBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bid[] = $bid;

        return $this;
    }

    /**
     * Remove bid
     *
     * @param \AppBundle\Entity\Bid $bid
     */
    public function removeBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bid->removeElement($bid);
    }

    /**
     * Get bid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Subscription
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get subscriptionLabel
     *
     * @return string
     */
 /*   public function getSubscriptionLabel(){
        $name =$this->getName();
        $note =$this->getNote();
        $description =$this->getDescription();
        $price =$this->getValue();

        $qualifiedName = ' ';
        $qualifiedName .= '<strong>'.$name.'</strong>';


        return$qualifiedName;

    }*/


    /**
     * Set note
     *
     * @param string $note
     *
     * @return Subscription
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
}
