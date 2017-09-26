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
 * @ORM\Entity
 * @ORM\Table(name="chukoloBanks")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChukoloBankRepository")
 *  @Vich\Uploadable
 *
 * anytime a payment is made an earning is crated
 */
class  ChukoloBank
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10,nullable=false)
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=10,nullable=false)
     */
    protected $accountOfficer;
    /**
     * @ORM\Column(type="string", length=10,nullable=false)
     */
    protected $bookBalance;
    /**
     * @ORM\Column(type="string", length=50,nullable=false)
     */
    protected $accountName;
    /**
     * @ORM\Column(type="integer", length=10,nullable=false)
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 10,
     *      minMessage = "Your Account Number must be at least {{ limit }} characters long",
     *      maxMessage = "Your Account Number  cannot be longer than {{ limit }} characters"
     * )
     */

    protected $accountNumber;




}
