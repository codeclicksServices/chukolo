<?php

namespace AppBundle\Entity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 *  @Vich\Uploadable
 */

class Project
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $description;
    /**
     * @ORM\Column(type="datetime")
     * date created
     */
    protected $created;

    /**
     * @ORM\Column(type="date",nullable=true, options={"comment":"this is use to make when the bidding will expire you canpurchase an extention or choose from the list of bids you have already"})
     */
    protected $expire;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"value: is the price plus suscrubtions "})
     *
     */
    protected $value;
    /**
     * @ORM\Column(type="integer", nullable=true, options={"comment":" price: this is the agreed
     * amount between the employer and the freelancer"})
     *
     */
    protected $price;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"comment":" average bid i.es number of bid /bidvalue"})
     *
     */
    protected $averageBid;

    /**
     * @ORM\Column(type="smallint",nullable=true)
     */
    protected $visible;
    /**
     * @ORM\Column(type="string", length=100,options={"comment":"current state of the project"})
     */
    protected $state;
    /**
     * @ORM\Column(type="string", length=100,options={"comment":"is it a fixed project or time based "})
     */
    protected $type;
    /**
     * @ORM\Column(type="smallint",options={"comment":"discontinue a project"})
     */
    protected $discontinue;
    /**
     * @ORM\Column(type="smallint",options={"comment":"deleting a project"})
     */
    protected $deleted;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"how many people viewed the project"})
     */
    protected $viewed;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="project_file", fileNameProperty="documentName")
     *
     * @var File
     */
    private $documentFile;

    /**
     * @ORM\Column(type="string", nullable=true,length=255)
     *
     * @var string
     */
    private $documentName;


    /*
     *relationships
     */
    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="project")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

    /**
     * @ORM\ManyToMany(targetEntity="Skill", inversedBy="project")
     * @ORM\JoinTable(name="project_skills")
     */
    private $skill;
    /**
     * @ORM\ManyToMany(targetEntity="Subscription", inversedBy="project")
     * @ORM\JoinTable(name="project_subscription")
     */
    private $subscription;

    /**
     *  @ORM\OneToMany(targetEntity="Bid", mappedBy="project")
     */
    protected $bid;




    /**
     * @ORM\ManyToOne(targetEntity="Budget", inversedBy="project")
     */

    private $budget;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="project")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;



    public function __construct() {
        $this->bid = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Project
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
     * @return Project
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
     * @return Project
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
     * Set expire
     *
     * @param \DateTime $expire
     *
     * @return Project
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;

        return $this;
    }

    /**
     * Get expire
     *
     * @return \DateTime
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return Project
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
     * Set price
     *
     * @param integer $price
     *
     * @return Project
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set visible
     *
     * @param integer $visible
     *
     * @return Project
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return integer
     */
    public function getVisible()
    {
        return $this->visible;
    }


    /**
     * Set discontinue
     *
     * @param integer $discontinue
     *
     * @return Project
     */
    public function setDiscontinue($discontinue)
    {
        $this->discontinue = $discontinue;

        return $this;
    }

    /**
     * Get discontinue
     *
     * @return integer
     */
    public function getDiscontinue()
    {
        return $this->discontinue;
    }

    /**
     * Set viewed
     *
     * @param integer $viewed
     *
     * @return Project
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;

        return $this;
    }

    /**
     * Get viewed
     *
     * @return integer
     */
    public function getViewed()
    {
        return $this->viewed;
    }



    /**
     * Add bid
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return Project
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
     * Set budget
     *
     * @param \AppBundle\Entity\Budget $budget
     *
     * @return Project
     */
    public function setBudget(\AppBundle\Entity\Budget $budget = null)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return \AppBundle\Entity\Budget
     */
    public function getBudget()
    {
        return $this->budget;
    }


    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $document
     *
     * @return Project
     */
    public function setDocumentFile(File $document = null)
    {
        $this->documentFile = $document;

        if ($document) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getDocumentFile()
    {
        return $this->documentFile;
    }

    /**
     * @param string $documentName
     *
     * @return Project
     */
    public function setImageName($documentName)
    {
        $this->documentName = $documentName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentName()
    {
        return $this->documentName;
    }


    /**
     * Set documentName
     *
     * @param string $documentName
     *
     * @return Project
     */
    public function setDocumentName($documentName)
    {
        $this->documentName = $documentName;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Project
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Project
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }




    /**
     * Add budget
     *
     * @param \AppBundle\Entity\Budget $budget
     *
     * @return Project
     */
    public function addBudget(\AppBundle\Entity\Budget $budget)
    {
        $this->budget[] = $budget;

        return $this;
    }

    /**
     * Remove budget
     *
     * @param \AppBundle\Entity\Budget $budget
     */
    public function removeBudget(\AppBundle\Entity\Budget $budget)
    {
        $this->budget->removeElement($budget);
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Project
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Project
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
     * Add skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return Project
     */
    public function addSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\Skill $skill
     */
    public function removeSkill(\AppBundle\Entity\Skill $skill)
    {
        $this->skill->removeElement($skill);
    }

    /**
     * Get skill
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Add subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     *
     * @return Project
     */
    public function addSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscription[] = $subscription;

        return $this;
    }

    /**
     * Remove subscription
     *
     * @param \AppBundle\Entity\Subscription $subscription
     */
    public function removeSubscription(\AppBundle\Entity\Subscription $subscription)
    {
        $this->subscription->removeElement($subscription);
    }

    /**
     * Get subscription
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Project
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
     * Set averageBid
     *
     * @param integer $averageBid
     *
     * @return Project
     */
    public function setAverageBid($averageBid)
    {
        $this->averageBid = $averageBid;

        return $this;
    }

    /**
     * Get averageBid
     *
     * @return integer
     */
    public function getAverageBid()
    {
        return $this->averageBid;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     *
     * @return Project
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
