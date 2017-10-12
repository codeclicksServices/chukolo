<?php

namespace AppBundle\Repository;

/**
 * SubscriptionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubscriptionRepository extends \Doctrine\ORM\EntityRepository
{

    public function findBidSubscription() {
        return $this
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.type = :bid')
            ->andWhere('e.enabled = :true')
            ->setParameter('bid',2)
            ->setParameter('enabled', 1)
            ->getQuery()
            ->getResult();
    }

}
