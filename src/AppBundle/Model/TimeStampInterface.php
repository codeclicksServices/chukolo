<?php
namespace AppBundle\Model;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */
interface TimeStampInterface
{
    /**
     * @return \DateTime
     */
    public function getCreatedAt();
    /**
     * @return \DateTime
     */
    public function getUpdatedAt();
    /**
     * @return \DateTime
     */
    public function getAwardedAt();
    /**
     * @return \DateTime
     */
    public function getExpiresAt();
    /**
     * @return \DateTime
     */
    public function getCompletedAt();





    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * @param \DateTime $createdAt
     */
    public function setAwardedAt(\DateTime $createdAt);

    /**
     * @param \DateTime $updatedAt
     */
    public function setCompletedAt(\DateTime $updatedAt);
    /**
     * @param \DateTime $updatedAt
     */
    public function setExpiresAt(\DateTime $updatedAt);
}
