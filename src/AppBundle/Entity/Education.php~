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
 * @ORM\Table(name="educations")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EducationRepository")
 *  @Vich\Uploadable
 */
class Education
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
    protected $degree;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $department;
    /**
     * @ORM\Column(type="date")
     * date created
     */
    protected $started;
    /**
     * @ORM\Column(type="date")
     * date created
     */
    protected $ended;
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $school;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $grade;

    /**
     * @ORM\Column(type="text",nullable=true)
     */
    protected $note;



    /*relationship*/


    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="education")
     * @ORM\JoinColumn(name="owner_id",referencedColumnName="id", nullable=false )
     */
    protected $owner;





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
     * Set started
     *
     * @param \DateTime $started
     *
     * @return Education
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set ended
     *
     * @param \DateTime $ended
     *
     * @return Education
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;

        return $this;
    }

    /**
     * Get ended
     *
     * @return \DateTime
     */
    public function getEnded()
    {
        return $this->ended;
    }



    /**
     * Set grade
     *
     * @param string $grade
     *
     * @return Education
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Education
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

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\Member $owner
     *
     * @return Education
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
     * Set degree
     *
     * @param string $degree
     *
     * @return Education
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return string
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set department
     *
     * @param string $department
     *
     * @return Education
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set school
     *
     * @param string $school
     *
     * @return Education
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }
}
