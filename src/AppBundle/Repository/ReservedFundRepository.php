<?php

namespace AppBundle\Repository;

/**
 * ReservedFundRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservedFundRepository extends \Doctrine\ORM\EntityRepository
{
public function getMyReserveFundForBid($member,$bid,$subscription) {
        return $this
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.member = :member')
            ->andWhere('e.bid = :bid')
            ->andWhere('e.subscription = :subscription')
            ->andWhere('e.status != :deleted')
            ->setParameter('deleted',"deleted")
            ->setParameter('member',$member)
            ->setParameter('subscription',$subscription)
            ->setParameter('bid', $bid)
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function getMyReserveFundForProcessingBidSubscription($member,$bid,$subscription) {
        return $this
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.member = :member')
            ->andWhere('e.bid = :bid')
            ->andWhere('e.subscription = :subscription')
            ->andWhere('e.status = :processing')
            ->setParameter('processing',"processing")
            ->setParameter('member',$member)
            ->setParameter('subscription',$subscription)
            ->setParameter('bid', $bid)
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /*todo when getting a fund reserved for this bid make sure it get only the one reserved for milestone payment and not subscription*/
    public function  getFundReservedForBid($bid,$source) {
        return $this
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.bid = :bid')
            ->andWhere('e.source = :source')
            ->andWhere('e.status != :deleted')
            ->setParameter('deleted',"deleted")
            ->setParameter('bid', $bid)
            ->setParameter('source', $source)
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            /*todo check what happens when the record is more than one */
            ->getSingleResult();

    }
}
