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
 * @ORM\Table(name="project_clause")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectClauseRepository")
 */
class ProjectClause
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, options={"comment":"The  name of the clause "}))
     */
    private $title;

    /**
     * @ORM\Column(type="text",options={"comment":"here you state what the clause is for eg:  you can't out source this project to a third party "} )
     */
    private $description;
    /**
     * @ORM\Column(type="text",options={"comment":" this is the allowed action to be taken when you break this clause eg: contract voided, you loose your bid and bid subscription etc"} )
     */
    private $penalty;
    /**
     * @ORM\Column(type="string", length=20, options={"comment":"which type of project have this clause eg  fixed project and  time-based project "})
     */
    protected $projectType;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"is this a general clause ? value would be true or false "})
     */
    protected $isGeneral;
    /**
     * @ORM\Column(type="smallint", length=1, options={"default":0,"comment":"for enabling and disabling clause usage "})
     */
    protected $enabled;

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
     * @return ProjectClause
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
     * @return ProjectClause
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
     * Set penalty
     *
     * @param string $penalty
     *
     * @return ProjectClause
     */
    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;

        return $this;
    }

    /**
     * Get penalty
     *
     * @return string
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * Set projectType
     *
     * @param integer $projectType
     *
     * @return ProjectClause
     */
    public function setProjectType($projectType)
    {
        $this->projectType = $projectType;

        return $this;
    }

    /**
     * Get projectType
     *
     * @return integer
     */
    public function getProjectType()
    {
        return $this->projectType;
    }

    /**
     * Set isGeneral
     *
     * @param integer $isGeneral
     *
     * @return ProjectClause
     */
    public function setIsGeneral($isGeneral)
    {
        $this->isGeneral = $isGeneral;

        return $this;
    }

    /**
     * Get isGeneral
     *
     * @return integer
     */
    public function getIsGeneral()
    {
        return $this->isGeneral;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return ProjectClause
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
