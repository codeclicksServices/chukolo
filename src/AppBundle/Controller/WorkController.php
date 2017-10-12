<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\MilestoneProposal;
use AppBundle\Entity\Project;
use AppBundle\Entity\Bid;
use AppBundle\Event\AppEvent;
use AppBundle\Event\ProjectCreatedEvent;
use AppBundle\Form\Type\BidType;
use AppBundle\Form\Type\MilestoneProposalType;
use AppBundle\Form\Type\MilestoneType;
use AppBundle\Form\Type\ProjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/project/{projectId}", name="project_details")
     */
    public function ShowAction(Request $request,$projectId)
    {
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $project=$Project->find($projectId);
        $bids = $project->getBid();
        $bid_count=count($project->getBid());

        return  $this->render('member/project/show.html.twig',array(
            'project'=>$project,
            'bids'=>$bids,
            'bid_count'=>$bid_count,

        ));
    }

    /**
     * @Route("/project/bid/{projectId}", name="bid_project")
     */
    public function ProjectBidAction(Request $request,$projectId)
    {
        /*
         * repos
        */
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $Subscription= $this->getDoctrine()->getRepository('AppBundle:Subscription');
        $Bid = $this->getDoctrine()->getRepository("AppBundle:Bid");
        /**
         * This is where a user  create bid for a particular project
         * bid for a particular project
         *
         */

        $bidSubscription=$Subscription->findBidSubscription();

        $project=$Project->find($projectId);
        $bids = $project->getBid();
        $bid_count=count($project->getBid());

        /*
         * form declearation
         */
        $bid = new Bid();
        $milestone= new MilestoneProposal();
        $form  = $this->createForm(BidType::class,$bid);
        $milestoneForm = $this->createForm(MilestoneProposalType::class,$milestone);
        $member=$this->getUser();


        $bidValue = "";
        $form->handleRequest($request);
        $milestoneForm->handleRequest($request);

        /*handles the ajax call  onNext clicked it
        creates the bid but not fully ready or being seen or used  */
        if ($form->isSubmitted() && $form->isValid()) {

            $price = $bid->getPrice();

            // this value is hard coded it
            // should come from the setting
            $commissionRate = 10;
            $commission = $price*$commissionRate/100;
            $bidValue = $price + $commission;

            $bid->setProject($project);
            //at this stage its not visible
            $bid->setVisible(0);
            $bid->setState("proposal");
            $bid->setCreated(new \DateTime('now'));
            $bid->setWithdrawn(0);
            $bid->setAwarded(0);
            $bid->setBookmark(0);
            $bid->setNumberOfMilestones(0);
            $bid->setHasMilestoneProposal(0);
            //this state means this bid is like a draft its not fully bod so its practically useless on less its complete
            $bid->setStage("initialize");
            $bid->setValue($bidValue);
            $bid->setCommission($commission);
            $bid->setCreatedAt(new \DateTime());
            $bid->setMember($member);
            //some  actions happens before or after  you place bid
            $em =$this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();



            return new Response(json_encode(array('status'=>'success')));
        }

        if ($milestoneForm->isSubmitted()&& $milestoneForm->isValid()){
            /*
             * the idea here is that a member can only create one bid for a particular project
             * since you are creating a milestone proposal for a bid it makes since to know the bid
             * to do that
             */


          $userBid=$Bid->getMyProjectBid($member,$project);
            //    $userBid =$Bid->findAll();
          if (!empty($userBid)){
              if($milestone->getAmount() <= $userBid->getValue()){

                  $milestone->setBid($userBid);
                  $milestone->setType("proposal");

                  $em =$this->getDoctrine()->getManager();
                  $em->persist($milestone);
                  // $em->flush($bid);
                  $em->flush();

                  return new Response(json_encode(array('status'=>'success')));
              }else{
                  return new Response(json_encode(array('status'=>'Your proposal must be smaller or equal to the value of your bid')));
              }
          }else{
              return new Response(json_encode(array('status'=>"can't  find a valid bid for this project")));
          }
        }






        return  $this->render('member/project/bid.html.twig',array(
            'form' => $form ->createView(),
            'milestoneForm'=>$milestoneForm->createView(),
            'project'=>$project,
            'subscription'=> $bidSubscription,
            'bids'=>$bids,
            'bid_count'=>$bid_count,
            'bidValue'=>$bidValue
        ));
    }

}