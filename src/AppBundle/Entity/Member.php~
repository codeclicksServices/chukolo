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

        $this->roles = array('ROLE_ MEMBER');
        $this->skill = new ArrayCollection();
        $this->project = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->review = new ArrayCollection();
        $this->milestone = new ArrayCollection();
        $this->bid = new ArrayCollection();
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

    /*address*/


    /**
     * @ORM\Column(type="string", length=20,nullable=true, options={"comment":" value: residential address "})
     */
    protected $address;
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
     * @ORM\Column(type="string", length=20,nullable=true, )
     */
    protected $company;

    /**
     * @ORM\Column(type="integer", length=100,nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="integer",  length=65,nullable=true, options={"default":1,"comment":"value: your trust level"})
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
     * @ORM\Column(type="smallint",nullable=true, options={"default":1})
     *
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
     * @ORM\ManyToMany(targetEntity="Skill", inversedBy="member")
     * @ORM\JoinTable(name="member_skills")
     */
    private $skill;

    /**
     * check the functionality of this later
     *  @ORM\OneToMany(targetEntity="Category", mappedBy="member")
     */
    protected $category;

    /**
     *  @ORM\OneToMany(targetEntity="Review", mappedBy="member")
     */
    protected $review;

    /**
     *  @ORM\OneToMany(targetEntity="Milestone", mappedBy="employer")
     */
    protected $milestone;

    /**
     *  @ORM\OneToMany(targetEntity="Portfolio", mappedBy="owner")
     */
    protected $portfolio;
    /**
     *  @ORM\OneToMany(targetEntity="Education", mappedBy="owner")
     */
    protected $education;
    /**
     *  @ORM\OneToMany(targetEntity="Publication", mappedBy="owner")
     */
    protected $publication;


    /**
     *  @ORM\OneToMany(targetEntity="XP", mappedBy="owner")
     */
    protected $xp;

    /**
     * @ORM\ManyToMany(targetEntity="Experience", inversedBy="member")
     * @ORM\JoinTable(name ="member_experience")
     */
    private $experience;

    /**
     * @ORM\ManyToMany(targetEntity="Verifiable", inversedBy="member")
     * @ORM\JoinTable(name ="member_verification")
     */
    private $verified;













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
     * Has skill
     *
     * @param \AppBundle\Entity\Skill $skill
     * @return boolean
     */
    public function hasSkill(\AppBundle\Entity\Skill $skill)
    {
        if($this->skill->contains($skill)){
            return true;
        }
        return false;
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

    /**
     * Set membership
     *
     * @param string $membership
     *
     * @return Member
     */
    public function setMembership($membership)
    {
        $this->membership = $membership;

        return $this;
    }

    /**
     * Get membership
     *
     * @return string
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * Add review
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return Member
     */
    public function addReview(\AppBundle\Entity\Review $review)
    {
        $this->review[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \AppBundle\Entity\Review $review
     */
    public function removeReview(\AppBundle\Entity\Review $review)
    {
        $this->review->removeElement($review);
    }

    /**
     * Get review
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Add experience
     *
     * @param \AppBundle\Entity\Experience $experience
     *
     * @return Member
     */
    public function addExperience(\AppBundle\Entity\Experience $experience)
    {
        $this->experience[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \AppBundle\Entity\Experience $experience
     */
    public function removeExperience(\AppBundle\Entity\Experience $experience)
    {
        $this->experience->removeElement($experience);
    }

    /**
     * Get experience
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Add verified
     *
     * @param \AppBundle\Entity\Verifiable $verified
     *
     * @return Member
     */
    public function addVerified(\AppBundle\Entity\Verifiable $verified)
    {
        $this->verified[] = $verified;

        return $this;
    }

    /**
     * Remove verified
     *
     * @param \AppBundle\Entity\Verifiable $verified
     */
    public function removeVerified(\AppBundle\Entity\Verifiable $verified)
    {
        $this->verified->removeElement($verified);
    }

    /**
     * Get verified
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Add milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     *
     * @return Member
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
     * Add portfolio
     *
     * @param \AppBundle\Entity\Portfolio $portfolio
     *
     * @return Member
     */
    public function addPortfolio(\AppBundle\Entity\Portfolio $portfolio)
    {
        $this->portfolio[] = $portfolio;

        return $this;
    }

    /**
     * Remove portfolio
     *
     * @param \AppBundle\Entity\Portfolio $portfolio
     */
    public function removePortfolio(\AppBundle\Entity\Portfolio $portfolio)
    {
        $this->portfolio->removeElement($portfolio);
    }

    /**
     * Get portfolio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }

    /**
     * Add education
     *
     * @param \AppBundle\Entity\Education $education
     *
     * @return Member
     */
    public function addEducation(\AppBundle\Entity\Education $education)
    {
        $this->education[] = $education;

        return $this;
    }

    /**
     * Remove education
     *
     * @param \AppBundle\Entity\Education $education
     */
    public function removeEducation(\AppBundle\Entity\Education $education)
    {
        $this->education->removeElement($education);
    }

    /**
     * Get education
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Add xp
     *
     * @param \AppBundle\Entity\XP $xp
     *
     * @return Member
     */
    public function addXp(\AppBundle\Entity\XP $xp)
    {
        $this->xp[] = $xp;

        return $this;
    }

    /**
     * Remove xp
     *
     * @param \AppBundle\Entity\XP $xp
     */
    public function removeXp(\AppBundle\Entity\XP $xp)
    {
        $this->xp->removeElement($xp);
    }

    /**
     * Get xp
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getXp()
    {
        return $this->xp;
    }

    /**
     * Add publication
     *
     * @param \AppBundle\Entity\Publication $publication
     *
     * @return Member
     */
    public function addPublication(\AppBundle\Entity\Publication $publication)
    {
        $this->publication[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param \AppBundle\Entity\Publication $publication
     */
    public function removePublication(\AppBundle\Entity\Publication $publication)
    {
        $this->publication->removeElement($publication);
    }

    /**
     * Get publication
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Member
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Member
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}
