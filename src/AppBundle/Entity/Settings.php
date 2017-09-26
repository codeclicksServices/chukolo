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
 * for storing global settings
 * @ORM\Entity
 * @ORM\Table(name="settings")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SettingRepository")
 * @Vich\Uploadable
 */
class  Settings
{
    /**
     * note for any setting you create you have to include the field to the owners entity
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":" settings name lowercase and underscore for space"})
     *
     */
    protected $name;
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":" settings title display text"})
     *
     */
    protected $title;
    /**
     * @ORM\Column(type="integer", nullable=false, options={"comment":" settings code tells the type of setting ie 1= admin,2=support,3=member,4 = developers "})
     *
     */
    protected $code;
    /**
     * @ORM\Column(type="array", nullable=false, options={"comment":" setting is option value array."})
     *
     */
    protected $setting;
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":" default settings ."})
     *
     */
    protected $default;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     */
    protected $description;






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
     * @return Settings
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
     * Set value
     *
     * @param integer $value
     *
     * @return Settings
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
     * Set description
     *
     * @param string $description
     *
     * @return Settings
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
     * Set title
     *
     * @param string $title
     *
     * @return Settings
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
     * Set code
     *
     * @param integer $code
     *
     * @return Settings
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set setting
     *
     * @param array $setting
     *
     * @return Settings
     */
    public function setSetting($setting)
    {
        $this->setting = $setting;

        return $this;
    }

    /**
     * Get setting
     *
     * @return array
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * Set default
     *
     * @param string $default
     *
     * @return Settings
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }
}
