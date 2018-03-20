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
 *
 * @ORM\Entity
 * @ORM\Table(name="sources")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SourceRepository")
 *  @Vich\Uploadable
 */

class Source
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", nullable=false,length=255)
     *
     * @var string
     */
    private $urlLink;


    /*
     *relationships
     */


    /**
     * @ORM\ManyToOne(targetEntity="Bid",inversedBy="source")
     * @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     */
    protected $contract;


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
     * Set urlLink
     *
     * @param string $urlLink
     *
     * @return Source
     */
    public function setUrlLink($urlLink)
    {
        $this->urlLink = $urlLink;

        return $this;
    }

    /**
     * Get urlLink
     *
     * @return string
     */
    public function getUrlLink()
    {
        return $this->urlLink;
    }

    /**
     * Set contract
     *
     * @param \AppBundle\Entity\Bid $contract
     *
     * @return Source
     */
    public function setContract(\AppBundle\Entity\Bid $contract = null)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return \AppBundle\Entity\Bid
     */
    public function getContract()
    {
        return $this->contract;
    }
}
