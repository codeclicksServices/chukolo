<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="members")
 * @UniqueEntity(fields = "username", targetClass = "AppBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "AppBundle\Entity\User", message="fos_user.email.already_used")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"member-settings" = "AppBundle\Entity\Membersetting"})
 */
class Member extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->roles = array('ROLE_ MEMBER');
        $this->skill = new ArrayCollection();
        $this->project = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    protected $firstName;
    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    protected $lastName;
    /**
     * @ORM\Column(type="string", length=20,nullable=true)
     */
    protected $gender;







    /**
     * @ORM\Column(type="string", length=65,nullable=true, options={"comment":"value: is either hire or work"})
     */
    protected $accountType;
    /**
     * @ORM\Column(type="string", length=5,nullable=true, options={"comment":"value: local currency in nigeria it would be NGN"})
     */
    protected $currency;




    /*address*/
    /**
     * @ORM\Column(type="string", length=20,nullable=true, options={"comment":"value:city of resident "})
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=20,nullable=true, options={"comment":"value:state of resident "})
     */
    protected $province;

    /**
     * @ORM\Column(type="string", length=20,nullable=true, options={"comment":"value:count of resident "})
     */
    protected $country;
    /**
     * @ORM\Column(type="string", length=20,nullable=true, options={"comment":"value:current location of the user"})
     */
    protected $location;

    /**
     * @ORM\Column(type="integer", length=100,nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="integer",  length=65,nullable=false, options={"comment":"value: your trust level"})
     */
    protected $trustScore;

    /**
     * @ORM\Column(type="string", length=65,nullable=true, options={"comment":"value: your area of specialty"})
     */
    protected $profession;

    /**
     * @ORM\Column(type="text",nullable=true,options={"comment":"value: introduction about yourself i.e selling yourself with the fewest possible words "})
     */
    protected $description;


 
    /**
     * @ORM\Column(type="integer",nullable=true, options={"unsigned":true, "default":0})
     */
    protected $login_count;

    /**
     * @ORM\Column(type="smallint",nullable=true, options={"unsigned":true, "default":0})
     */
    protected $updated;

    /**
     * @ORM\Column(type="smallint")
     *@Assert\NotBlank()
     */
    protected $consent;







    //relationships


    /**
     *  @ORM\OneToMany(targetEntity="Project", mappedBy="member")
     */
    protected $project;
    /**
     *  @ORM\OneToMany(targetEntity="Project", mappedBy="member")
     */
    protected $bid;
    /**
     *  @ORM\OneToMany(targetEntity="Skill", mappedBy="member")
     */
    protected $skill;
    /**
     *  @ORM\OneToMany(targetEntity="Category", mappedBy="member")
     */
    protected $category;



    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Member
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Member
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Member
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set loginCount
     *
     * @param integer $loginCount
     *
     * @return Member
     */
    public function setLoginCount($loginCount)
    {
        $this->login_count = $loginCount;

        return $this;
    }

    /**
     * Get loginCount
     *
     * @return integer
     */
    public function getLoginCount()
    {
        return $this->login_count;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     *
     * @return Member
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Member
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return Member
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Member
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
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Member
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
     * Add skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return Member
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
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Member
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add bid
     *
     * @param \AppBundle\Entity\Project $bid
     *
     * @return Member
     */
    public function addBid(\AppBundle\Entity\Project $bid)
    {
        $this->bid[] = $bid;

        return $this;
    }

    /**
     * Remove bid
     *
     * @param \AppBundle\Entity\Project $bid
     */
    public function removeBid(\AppBundle\Entity\Project $bid)
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
     * Set consent
     *
     * @param integer $consent
     *
     * @return Member
     */
    public function setConsent($consent)
    {
        $this->consent = $consent;

        return $this;
    }

    /**
     * Get consent
     *
     * @return integer
     */
    public function getConsent()
    {
        return $this->consent;
    }

    /**
     * Set accountType
     *
     * @param string $accountType
     *
     * @return Member
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return string
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Member
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
     * Set city
     *
     * @param string $city
     *
     * @return Member
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return Member
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Member
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Member
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }



    /**
     * Set trustScore
     *
     * @param integer $trustScore
     *
     * @return Member
     */
    public function setTrustScore($trustScore)
    {
        $this->trustScore = $trustScore;

        return $this;
    }

    /**
     * Get trustScore
     *
     * @return integer
     */
    public function getTrustScore()
    {
        return $this->trustScore;
    }
}
