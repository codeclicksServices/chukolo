<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Bid;
use AppBundle\Event\AppEvent;
use AppBundle\Event\ProjectCreatedEvent;
use AppBundle\Form\Type\BidType;
use AppBundle\Form\Type\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 *
 * Responsible for any action relating to getting to work for an employer .
 */
class WorkController extends Controller
{


    /**
    * @Route("/jobs", name="brows_jobs")
     */
    public function BrowseAllJobsAction(Request $request)
    {
        /**
         * get the most recently completed projects/jobs
         * view all the jobs/projects
         */
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $rescentCompletedJob=$Project->findAll();




        /*
         * paginator to use*/
        $paginator  = $this->get('knp_paginator');
        //default page limit
        $pageLimit= 4;


        /*
         * project pagination queries (i.e what actually get to the front end)
         */

        $openProjectsQuery =$Project->findAll();

        /*
         * paginationgs (i.e what actually get to the front end)
         */
        $alljobs = $paginator->paginate($openProjectsQuery,$request->query->getInt('page', 1),$pageLimit);






        return  $this->render('member/project/index.html.twig',array(
            'allJobs'=>$alljobs,
        ));
    }


    /**
     *
     *
     * browse all the jobs within your location that match your skills
     *
     *
     * @Route("/jobs/local/", name="brows_local_jobs")
     */
    public function BrowseLocaleJobsAction(Request $request)
    {

        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $rescentCompletedJob=$Project->findAll();
        $alljobs = $Project->findAll();


        return  $this->render('project/index.html.twig',array(
            'rescentCompletedJob'=>$rescentCompletedJob,
        ));
    }




    /**
     *
     * for category wide search
     *
     * @Route("/jobs/director/{directoryId}", name="brows_Directory")
     */
    public function BrowseDirectoryAction(Request $request,$directoryId)
    {
        /**
         * get the most recently completed projects/jobs
         * view all the jobs/projects
         */
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $rescentCompletedJob=$Project->findAll();
        $alljobs = $Project->findAll();


        return  $this->render('project/index.html.twig',array(
            'rescentCompletedJob'=>$rescentCompletedJob,
        ));
    }







    /**
     * This shows a particular project with
     * details and people biding the project
     * @Route("/project/{id}", name="project_show")
     */
    public function ShowAction(Request $request,$id)
    {
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $project=$Project->find($id);
        $bids = $project->getBid();
        $bid_count=count($project->getBid());

        $bid = new Bid();

       $form  = $this->createForm(BidType::class,$bid)
            ->add('save',SubmitType::class, array(
                'label'=>'Place Your Bid'
            ));
        $member=$this->getUser();
        $this->getUser();

        $bidValue = "";
        $form->handleRequest($request);
        if ($form->isValid()){
            $price = $bid->getPrice();

            // this value is hard coded it
            // should come from the setting
            $commissionRate = 10;
            $commission = $price*$commissionRate/100;
            $bidValue = $price + $commission;

            $bid->setProject($project);
            $bid->setVisible(1);

            $bid->setState("proposal");
            $bid->setCreated(new \DateTime('now'));
            $bid->setWithdrawn(0);
            $bid->setAwarded(0);
            $bid->setBookmark(0);
            $bid->setStage("created");
            $bid->setValue($bidValue);
            $bid->setCommission($commission);
            $bid->setCreatedAt(new \DateTime());
            $bid->setMember($member);
                   //some  actions happens before or after  you place bid
            $em =$this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();
                 //included events that is handle on bid creation


            return $this->redirect($this->generateUrl('project_show',
                array('id' => $id, )));
        }

        return  $this->render('member/project/show.html.twig',array(
            'form' => $form ->createView(),
            'project'=>$project,
            'bids'=>$bids,
            'bid_count'=>$bid_count,
            'bidValue'=>$bidValue
        ));
    }

    /**
     * @Route("/project/bid/{projectId}", name="bid project")
     */
    public function ProjectBidAction(Request $request)
    {

        /**
         * This is where a user  create bid for a particular project
         * bid for a particular project
         *
         */


        return  $this->render('default/bid.html.twig',array());
    }

}