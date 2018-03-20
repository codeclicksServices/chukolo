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
 * note this is not related table its extended i.e a continuation of the member table
 * @ORM\Entity
 * @ORM\Table(name="member_settings")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MembersettingRepository")
 *  @Vich\Uploadable
 */
class  Membersetting extends Member
{
    /**
     * note for any setting you create you have to include the field to the owners entity
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="text", options={"comment":" secondary email is where we send you notice of the happenings on chukolo "})
     *
     */
    protected $secondaryEmail;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":" Allow Freelancers to follow me, notifying them of projects I've posted"})
     *
     */
    protected $allowFollow;

    /**
     * @ORM\Column(type="string", length=65,nullable=false, options={"default":"work","comment":"value: is either hire or work"})
     */
    protected $accountType;
    /**
     * @ORM\Column(type="string", length=65,nullable=false, options={"default":"free","comment":"value: is either free or paid "})
     */
    protected $membership;
    /**
     * @ORM\Column(type="string", length=5,nullable=true, options={"default":"NGN","comment":"value: local currency in nigeria it would be NGN"})
     */
    protected $currency;

    /**
     * @ORM\Column(type="string", length=20,nullable=true, options={"comment":"value:current location of the user"})
     */
    protected $location;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":"When project get posted that match my skils"})
     *
     */
    protected $notifyPostedJobs;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":" When a local job in my location is posted"})
     *
     */
    protected $notifyLocalJobs;
    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":" When you receive a message from a contact"})
     *
     */
    protected $notifyContactMessage;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":"When you receive a message about a project"})
     *
     */
    protected $notifyProjectMessage;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":"When you receive a message from chukolo staff "})
     *
     */
    protected $notifyStaffMessage;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":" News and announcements from Chukolo "})
     *
     */
    protected $notifyChukoloNews;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":" A buyer awards you a project"})
     *
     */
    protected $notifyAwardedJob;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":"A freelancer requests you to release a milestone payment  "})
     *
     */
    protected $notifyReleaseMilestoneRequest;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":" An employer release a milestone payment "})
     *
     */
    protected $notifyReleaseMilestone;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":"We notify you of the top bidder for your project."})
     *
     */
    protected $notifyTopBidder;

    /**
     * @ORM\Column(type="smallint", options={"default":1,"comment":"We notify you of the latest activity regarding Services"})
     *
     */
    protected $notifyServiceActivity;




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
     * Set secondaryEmail
     *
     * @param \email $secondaryEmail
     *
     * @return Membersetting
     */
    public function setSecondaryEmail(\email $secondaryEmail)
    {
        $this->secondaryEmail = $secondaryEmail;

        return $this;
    }

    /**
     * Get secondaryEmail
     *
     * @return \email
     */
    public function getSecondaryEmail()
    {
        return $this->secondaryEmail;
    }

    /**
     * Set allowFollow
     *
     * @param integer $allowFollow
     *
     * @return Membersetting
     */
    public function setAllowFollow($allowFollow)
    {
        $this->allowFollow = $allowFollow;

        return $this;
    }

    /**
     * Get allowFollow
     *
     * @return integer
     */
    public function getAllowFollow()
    {
        return $this->allowFollow;
    }


    /**
     * Set membership
     *
     * @param string $membership
     *
     * @return Membersetting
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
     * Set notifyPostedJobs
     *
     * @param integer $notifyPostedJobs
     *
     * @return Membersetting
     */
    public function setNotifyPostedJobs($notifyPostedJobs)
    {
        $this->notifyPostedJobs = $notifyPostedJobs;

        return $this;
    }

    /**
     * Get notifyPostedJobs
     *
     * @return integer
     */
    public function getNotifyPostedJobs()
    {
        return $this->notifyPostedJobs;
    }

    /**
     * Set notifyContactMessage
     *
     * @param integer $notifyContactMessage
     *
     * @return Membersetting
     */
    public function setNotifyContactMessage($notifyContactMessage)
    {
        $this->notifyContactMessage = $notifyContactMessage;

        return $this;
    }

    /**
     * Get notifyContactMessage
     *
     * @return integer
     */
    public function getNotifyContactMessage()
    {
        return $this->notifyContactMessage;
    }

    /**
     * Set notifyProjectMessage
     *
     * @param integer $notifyProjectMessage
     *
     * @return Membersetting
     */
    public function setNotifyProjectMessage($notifyProjectMessage)
    {
        $this->notifyProjectMessage = $notifyProjectMessage;

        return $this;
    }

    /**
     * Get notifyProjectMessage
     *
     * @return integer
     */
    public function getNotifyProjectMessage()
    {
        return $this->notifyProjectMessage;
    }

    /**
     * Set notifyLocalJobs
     *
     * @param integer $notifyLocalJobs
     *
     * @return Membersetting
     */
    public function setNotifyLocalJobs($notifyLocalJobs)
    {
        $this->notifyLocalJobs = $notifyLocalJobs;

        return $this;
    }

    /**
     * Get notifyLocalJobs
     *
     * @return integer
     */
    public function getNotifyLocalJobs()
    {
        return $this->notifyLocalJobs;
    }

    /**
     * Set notifyStaffMessage
     *
     * @param integer $notifyStaffMessage
     *
     * @return Membersetting
     */
    public function setNotifyStaffMessage($notifyStaffMessage)
    {
        $this->notifyStaffMessage = $notifyStaffMessage;

        return $this;
    }

    /**
     * Get notifyStaffMessage
     *
     * @return integer
     */
    public function getNotifyStaffMessage()
    {
        return $this->notifyStaffMessage;
    }

    /**
     * Set notifyChukoloNews
     *
     * @param integer $notifyChukoloNews
     *
     * @return Membersetting
     */
    public function setNotifyChukoloNews($notifyChukoloNews)
    {
        $this->notifyChukoloNews = $notifyChukoloNews;

        return $this;
    }

    /**
     * Get notifyChukoloNews
     *
     * @return integer
     */
    public function getNotifyChukoloNews()
    {
        return $this->notifyChukoloNews;
    }

    /**
     * Set notifyAwardedJob
     *
     * @param integer $notifyAwardedJob
     *
     * @return Membersetting
     */
    public function setNotifyAwardedJob($notifyAwardedJob)
    {
        $this->notifyAwardedJob = $notifyAwardedJob;

        return $this;
    }

    /**
     * Get notifyAwardedJob
     *
     * @return integer
     */
    public function getNotifyAwardedJob()
    {
        return $this->notifyAwardedJob;
    }

    /**
     * Set notifyReleaseMilestoneRequest
     *
     * @param integer $notifyReleaseMilestoneRequest
     *
     * @return Membersetting
     */
    public function setNotifyReleaseMilestoneRequest($notifyReleaseMilestoneRequest)
    {
        $this->notifyReleaseMilestoneRequest = $notifyReleaseMilestoneRequest;

        return $this;
    }

    /**
     * Get notifyReleaseMilestoneRequest
     *
     * @return integer
     */
    public function getNotifyReleaseMilestoneRequest()
    {
        return $this->notifyReleaseMilestoneRequest;
    }

    /**
     * Set notifyReleaseMilestone
     *
     * @param integer $notifyReleaseMilestone
     *
     * @return Membersetting
     */
    public function setNotifyReleaseMilestone($notifyReleaseMilestone)
    {
        $this->notifyReleaseMilestone = $notifyReleaseMilestone;

        return $this;
    }

    /**
     * Get notifyReleaseMilestone
     *
     * @return integer
     */
    public function getNotifyReleaseMilestone()
    {
        return $this->notifyReleaseMilestone;
    }

    /**
     * Set notifyTopBidder
     *
     * @param integer $notifyTopBidder
     *
     * @return Membersetting
     */
    public function setNotifyTopBidder($notifyTopBidder)
    {
        $this->notifyTopBidder = $notifyTopBidder;

        return $this;
    }

    /**
     * Get notifyTopBidder
     *
     * @return integer
     */
    public function getNotifyTopBidder()
    {
        return $this->notifyTopBidder;
    }

    /**
     * Set notifyServiceActivity
     *
     * @param integer $notifyServiceActivity
     *
     * @return Membersetting
     */
    public function setNotifyServiceActivity($notifyServiceActivity)
    {
        $this->notifyServiceActivity = $notifyServiceActivity;

        return $this;
    }

    /**
     * Get notifyServiceActivity
     *
     * @return integer
     */
    public function getNotifyServiceActivity()
    {
        return $this->notifyServiceActivity;
    }

    /**
     * Add review
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return Membersetting
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
     * Add milestone
     *
     * @param \AppBundle\Entity\Milestone $milestone
     *
     * @return Membersetting
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
     * @return Membersetting
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
     * @return Membersetting
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
     * @return Membersetting
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
     * @return Membersetting
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
     * @return Membersetting
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
     * @return Membersetting
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

    /**
     * Add deposit
     *
     * @param \AppBundle\Entity\Deposit $deposit
     *
     * @return Membersetting
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
     * Add bank
     *
     * @param \AppBundle\Entity\MemberBank $bank
     *
     * @return Membersetting
     */
    public function addBank(\AppBundle\Entity\MemberBank $bank)
    {
        $this->bank[] = $bank;

        return $this;
    }

    /**
     * Remove bank
     *
     * @param \AppBundle\Entity\MemberBank $bank
     */
    public function removeBank(\AppBundle\Entity\MemberBank $bank)
    {
        $this->bank->removeElement($bank);
    }

    /**
     * Get bank
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Add fundLog
     *
     * @param \AppBundle\Entity\FundLog $fundLog
     *
     * @return Membersetting
     */
    public function addFundLog(\AppBundle\Entity\FundLog $fundLog)
    {
        $this->fundLog[] = $fundLog;

        return $this;
    }

    /**
     * Remove fundLog
     *
     * @param \AppBundle\Entity\FundLog $fundLog
     */
    public function removeFundLog(\AppBundle\Entity\FundLog $fundLog)
    {
        $this->fundLog->removeElement($fundLog);
    }

    /**
     * Get fundLog
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFundLog()
    {
        return $this->fundLog;
    }

    /**
     * Set accountType
     *
     * @param string $accountType
     *
     * @return Membersetting
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
     * @return Membersetting
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
     * Set location
     *
     * @param string $location
     *
     * @return Membersetting
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Membersetting
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
     * @return Membersetting
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
     * Set gender
     *
     * @param string $gender
     *
     * @return Membersetting
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
     * Set city
     *
     * @param string $city
     *
     * @return Membersetting
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
     * @return Membersetting
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
     * @return Membersetting
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
     * Set phone
     *
     * @param integer $phone
     *
     * @return Membersetting
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
     * Set trustScore
     *
     * @param integer $trustScore
     *
     * @return Membersetting
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
     * Set profession
     *
     * @param string $profession
     *
     * @return Membersetting
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
     * @return Membersetting
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
     * Set loginCount
     *
     * @param integer $loginCount
     *
     * @return Membersetting
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
     * @return Membersetting
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
     * Set consent
     *
     * @param integer $consent
     *
     * @return Membersetting
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
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Membersetting
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
     * @param \AppBundle\Entity\Project $bid
     *
     * @return Membersetting
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
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Membersetting
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
     * Add reservedFund
     *
     * @param \AppBundle\Entity\ReservedFund $reservedFund
     *
     * @return Membersetting
     */
    public function addReservedFund(\AppBundle\Entity\ReservedFund $reservedFund)
    {
        $this->reservedFund[] = $reservedFund;

        return $this;
    }

    /**
     * Remove reservedFund
     *
     * @param \AppBundle\Entity\ReservedFund $reservedFund
     */
    public function removeReservedFund(\AppBundle\Entity\ReservedFund $reservedFund)
    {
        $this->reservedFund->removeElement($reservedFund);
    }

    /**
     * Get reservedFund
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservedFund()
    {
        return $this->reservedFund;
    }

    /**
     * Set registered
     *
     * @param \DateTime $registered
     *
     * @return Membersetting
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Get registered
     *
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Add memberBank
     *
     * @param \AppBundle\Entity\MemberBank $memberBank
     *
     * @return Membersetting
     */
    public function addMemberBank(\AppBundle\Entity\MemberBank $memberBank)
    {
        $this->memberBank[] = $memberBank;

        return $this;
    }

    /**
     * Remove memberBank
     *
     * @param \AppBundle\Entity\MemberBank $memberBank
     */
    public function removeMemberBank(\AppBundle\Entity\MemberBank $memberBank)
    {
        $this->memberBank->removeElement($memberBank);
    }

    /**
     * Get memberBank
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberBank()
    {
        return $this->memberBank;
    }

    /**
     * Set authCode
     *
     * @param string $authCode
     *
     * @return Membersetting
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;

        return $this;
    }

    /**
     * Get authCode
     *
     * @return string
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Membersetting
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
