<?php
namespace AppBundle\Model;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */
trait TimeStampTrait
{
    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * @var \DateTime
     */
    protected  $expiresAt;
    /**
     * @var \DateTime
     */
    protected $awardedAt;
    /**
     * @var \DateTime
     */
    protected  $completedAt;






    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getAwardedAt(){
       return $this->awardedAt;
    }
    /**
     * @return \DateTime
     */
    public function getExpiresAt(){
       return $this->expiresAt;
    }
    /**
     * @return \DateTime
     */
    public function getCompletedAt(){
      return $this->completedAt;
    }



    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->createdAt = $expiresAt;
    }

    /**
     * @param \DateTime $completedAt
     */
    public function setCompletedAt(\DateTime $completedAt)
    {
        $this->updatedAt = $completedAt;
    }
    /**
     * @param \DateTime $awardedAt
     */
    public function setAwardedAt(\DateTime $awardedAt)
    {
        $this->updatedAt = $awardedAt;
    }
}