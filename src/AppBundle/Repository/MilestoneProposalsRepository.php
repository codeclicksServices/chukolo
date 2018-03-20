<?php

namespace AppBundle\Repository;

/**
 * MilestoneProposalsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MilestoneProposalsRepository extends \Doctrine\ORM\EntityRepository
{
    /*
     *
     */
    public function getBidOffers($bid){
        return $this
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.bid = :bid')
            ->andWhere('e.type= :type')
            ->andWhere('e.status= :active')
            ->setParameter('type',"offer")
            ->setParameter('active',"accept")
            ->setParameter('bid', $bid)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

}
