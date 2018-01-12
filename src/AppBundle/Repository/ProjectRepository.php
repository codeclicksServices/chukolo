<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Project;

/**
 * ProjectRepository
 */
class ProjectRepository extends EntityRepository
    {


    public function findCategoryProject($category)
    {
        return $this
            ->createQueryBuilder('l')
            ->select('p')
            ->from('AppBundle:Project','p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
        //don't to forget to put setting for fetching the maximum project
    }




    public function findMyProject($user,$state=null,$searchParam=null,$limit=null)
    {

        $query = $this ->createQueryBuilder('l')
            ->select('p')
            ->from('AppBundle:Project','p')
            ->where('p.deleted = :false')
            ->andWhere('p.member = :member')
            ->setParameter('false', 0)
            ->setParameter('member', $user);

        if(!$state == null){
            //convert to lowercase because all the state is stored in the lowercase in the database
            $transformedState=strtolower($state);
            $query =  $query->andWhere('p.state = :state')
                ->setParameter('state', $transformedState);

        }


        if(!$searchParam == null){

            $cleanedParam  = '%'.trim($searchParam).'%';

            $query = $query->andWhere('p.name LIKE :name')
                            ->orWhere('p.id LIKE :id')
                ->setParameter('name',$cleanedParam)
                ->setParameter('id',$cleanedParam);

        }

        if(!$limit == null){
            $query = $query->setMaxResults($limit);
        }

        $query->orderBy('p.created', 'DESC');
        $query = $query ->getQuery()->getResult();

        return $query;
    }



    public function findAllRecentProducts($limit) {
        return $this
            ->createQueryBuilder('e')
            ->select('e')
            ->where('e.created <= :now')
            ->andWhere('e.discontinue = :no')
            ->setParameter('no',0)
            ->setParameter('now', new \DateTime())
            ->orderBy('e.created', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    public function findAllPostedProject($user){
        return $this
            ->createQueryBuilder('n')
            ->select('n')
            ->where('n.member >= :member')
            ->setParameter('member', $user)
            ->getQuery()
            ->getResult();
    }


}
