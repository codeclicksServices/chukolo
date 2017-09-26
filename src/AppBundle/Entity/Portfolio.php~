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
 * @ORM\Table(name="portfolios")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PortfolioRepository")
 *  @Vich\Uploadable
 */
class Portfolio
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $title;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $description;


    /**
     * @Vich\UploadableField(mapping="portfolio_file", fileNameProperty="portfolioName")
     *
     * @var File
     */
    private $portfolioFile;

    /**
     * @ORM\Column(type="string", nullable=true,length=255)
     *
     * @var string
     */
    private $portfolioName;






    /*relationship*/


    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="portfolio")
     * @ORM\JoinColumn(name="owner_id",referencedColumnName="id", nullable=false )
     */
    protected $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="portfolio")
     * @ORM\JoinColumn(name="skill_id",referencedColumnName="id", nullable=false )
     */
    protected $skills;















    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $portfolio
     *
     * @return Portfolio
     */
    public function setPortfolioFile(File $portfolio = null)
    {
        $this->portfolioFile = $portfolio;

        if ($portfolio) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getPortfolioFile()
    {
        return $this->portfolioFile;
    }

    /**
     * @param string $portfolioName
     *
     * @return Portfolio
     */
    public function setPortfolioName($portfolioName)
    {
        $this->portfolioName = $portfolioName;

        return $this;
    }



    /**
     * Get bannerName
     *
     * @return string
     */
    public function getPortfolioName()
    {
        return $this->portfolioName;
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
     * Set title
     *
     * @param string $title
     *
     * @return Portfolio
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Portfolio
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
     * Set owner
     *
     * @param \AppBundle\Entity\Member $owner
     *
     * @return Portfolio
     */
    public function setOwner(\AppBundle\Entity\Member $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\Member
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set skills
     *
     * @param \AppBundle\Entity\Skill $skills
     *
     * @return Portfolio
     */
    public function setSkills(\AppBundle\Entity\Skill $skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkills()
    {
        return $this->skills;
    }
}
