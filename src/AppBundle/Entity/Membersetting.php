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
     * @ORM\Column(type="smallint", options={"comment":" Allow Freelancers to follow me, notifying them of projects I've posted"})
     *
     */
    protected $allowFollow;





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
}
