<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository as BaseRepository;
use AppBundle\Entity\Project;


/**
 * OrderRepository
 *
 */
class BudgetRepository extends  BaseRepository
    {

    public function findDepartmentProduct($department)
    {
       /* return $this
            ->createQueryBuilder('l')
            ->select('p')
            ->from('AppBundle:Product','p')
            ->join('p.group', 'g')
            ->join('g.category', 'c')
            ->join('c.department', 'd')
            ->where('d = :department')
            ->setParameter('department', $department)
            ->getQuery()
            ->getResult();*/

    }


}
