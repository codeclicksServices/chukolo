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
 * @ORM\Table(name="withdrawal")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WithdrawalRepository")
 *  @Vich\Uploadable
 */
class Withdrawal
{
    /**
     * once payment is mad to chukolo it comes here once its confirmed it can then be used
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="integer", length=50 ,nullable=false,options={"comment":"value: actual amount paid to chukolo account "})
     */
    protected $amount;
    /**
     * @ORM\Column(type="integer", length=50 ,nullable=false,options={"comment":"value:most time amount is equal to receive in case there is variation register"})
     */
    protected $received;
    /**
     * @ORM\Column(type="smallint",options={"comment":"value:if this withdrawal is complete the value would be removed from fund  it can be true or false"})
     * date created
     */
    protected $complete;
    /**
     * @ORM\Column(type="datetime",options={"comment":"value:date withdrawal was complete"})
     * date created
     */
    protected $complete_date;

    /**
     * @ORM\Column(type="string", length=20 ,nullable=false,options={"comment":"value: this can be either  processing release pending , withdrawn , ,declined "})
     */
    protected $status;

    /**
     * @ORM\Column(type="string", length=40 ,nullable=false,options={"comment":"value:in this case payer is chukolo"})
     */
    protected $payer;





    /*
     * this would have relationship with
     * 1 member receiving the money
     * 2 chukolos initiating banks
     * 3 the receiving bank(members registered outlet)
     * 4 the staff that confirmed the payment or if it a script confirming payment this would be false */


}