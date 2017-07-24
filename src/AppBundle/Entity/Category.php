<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *  @Vich\Uploadable
 * @ORM\Table(name="categories")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */

class Category
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
     * @ORM\Column(type="integer")
     */
    protected $position;
    /**
     * @ORM\Column(type="integer",options={"comment":"this is used to tell if it would be available on the project create for, and other paces "})
     */
    protected $priority;
    /**
     * @ORM\Column(type="smallint")
     *
     */
    protected $visible;
    /**
     * @ORM\Column(type="smallint",nullable=true,options={"comment":"makes it available at the front ent the value is true or false"})
     *
     */
    protected $homeDisplay;
    /**
     * @ORM\Column(type="integer",nullable=true,options={"comment":"the least amount the project can go for "})
     */
    protected $minValue;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="category_Icon", fileNameProperty="icon")
     *
     * @var File
     */
    private $iconFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $icon;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="category_logo", fileNameProperty="logo")
     *
     * @var File
     */
    private $logoFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $logo;









    //relationships

    /**
     * @ORM\ManyToMany(targetEntity="Skill", inversedBy="category")
     * @ORM\JoinTable(name="category_skills")
     */
    private $skill;
    /**
     *  @ORM\OneToMany(targetEntity="Project", mappedBy="category")
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="category")
     * @ORM\JoinColumn(name="member_id",referencedColumnName="id", nullable=true )
     */
    protected $member;



    public function __construct()
    {
        $this->skill = new ArrayCollection();
        $this->project = new ArrayCollection();
    }
    ////////////////////

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
     * @return Category
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
     * @return Category
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
     * Set position
     *
     * @param integer $position
     *
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set visible
     *
     * @param integer $visible
     *
     * @return Category
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
     * Add skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return Category
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
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Category
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
     * Add member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Category
     */
    public function addMember(\AppBundle\Entity\Member $member)
    {
        $this->member[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \AppBundle\Entity\Member $member
     */
    public function removeMember(\AppBundle\Entity\Member $member)
    {
        $this->member->removeElement($member);
    }

    /**
     * Get member
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMember()
    {
        return $this->member;
    }

    ////////////////////////

    /**
     * Set icon
     *
     *
     * @param string $icon
     * @return Category
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $icon
     *
     * @return Category
     */
    public function setIconFile(File $icon = null)
    {
        $this->iconFile = $icon;

        return $this;
    }

    /**
     * @return File
     */
    public function iconFile()
    {
        return $this->iconFile;
    }
////////////////////////

    /**
     * Set Logo
     *
     *
     * @param string $logo
     * @return Category
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $logo
     *
     * @return Category
     */
    public function setLogoFile(File $logo = null)
    {
        $this->logoFile = $logo;

        return $this;
    }

    /**
     * @return File
     */
    public function logoFile()
    {
        return $this->logoFile;
    }

/////////////////////////////////////////////

    /**
     * Set homeDisplay
     *
     * @param integer $homeDisplay
     *
     * @return Category
     */
    public function setHomeDisplay($homeDisplay)
    {
        $this->homeDisplay = $homeDisplay;

        return $this;
    }

    /**
     * Get homeDisplay
     *
     * @return integer
     */
    public function getHomeDisplay()
    {
        return $this->homeDisplay;
    }

    /**
     * Set minValue
     *
     * @param integer $minValue
     *
     * @return Category
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * Get minValue
     *
     * @return integer
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * Set member
     *
     * @param \AppBundle\Entity\Member $member
     *
     * @return Category
     */
    public function setMember(\AppBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Category
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
