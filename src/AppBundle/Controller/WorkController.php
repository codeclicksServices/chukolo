<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MilestoneProposal;
use AppBundle\Entity\Bid;
use AppBundle\Form\Type\BidType;
use AppBundle\Form\Type\MilestoneProposalType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 *
 * Responsible for any action relating to getting to work for an employer .
 */
class WorkController extends BaseController
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
    public function ShowProjectDetailAction(Request $request,$projectId)
    {   $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $Bid= $this->getDoctrine()->getRepository('AppBundle:Bid');
        $project=$Project->find($projectId);
        /*
         * todo: refactor this later to get the  bid based on visible bids instead of getting all the bid for this project  and records
        */
        $bids = $project->getBid();
        $member= $this->getUser();
        $bid_count=count($project->getBid());

        $userBid=$Bid->getMyProjectBid($member,$project);
        if(!empty($userBid)){
            $hasBid=$userBid[0];

        }else{
            $hasBid=null;
        }


        return  $this->render('member/project/show.html.twig',array(
            'project'=>$project,
            'bids'=>$bids,
            'bid_count'=>$bid_count,
            'hasUserBid'=> $hasBid

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
        /*
         * global decelerations
        */
        $member=$this->getUser();
        $bidSubscription=$Subscription->findBidSubscription();
        $project=$Project->find($projectId);
        $bids = $project->getBid();
        $bid_count=count($project->getBid());
        $workingBid="";
        $bidValue = "";

        /*   ///check for already created bid for this project
          * also use the state of this bid to decide what to present to the user
          * Working bid is he bid that the user is processing
          * */
        $userBids=$Bid->getMyProjectBid($member,$project);



        /*
         * form declaration
         */
        $bid = new Bid();
        $milestone= new MilestoneProposal();
        $form  = $this->createForm(BidType::class,$bid);
        $milestoneForm = $this->createForm(MilestoneProposalType::class,$milestone);
        $updateBidForm=null;

        $form->handleRequest($request);
        $milestoneForm->handleRequest($request);



        /*
         * handles the ajax call  onNext clicked it
        creates the bid but not fully ready or being seen or used
         */
        if ($form->isSubmitted() && $form->isValid()) {

            if(empty($userBids)){
                // bid will only be created if this user have not already created a bid.
                $this->CreateBid($bid,$project,$member);
            }


        }
        /*before you can start creating milestone proposal and all make sure there is bid*/
        if(!empty($userBids)){
            $workingBid=$userBids[0];


            /* for  creating a whole milestons proposal or  at once */
            if ($request->query->get('createOneMilestone')== 1){
                return  $this->CreateOneMilestone($workingBid,$request);
            }
              /*todo come back and create the second milestone proposal automatically*/
            if ($milestoneForm->isSubmitted() && $milestoneForm->isValid()) {
                if(!empty($userBids)) {
                    $bid=$userBids[0];

                    $this->CreateMilestone($bid,$milestone);
                }
            }

            if ($request->query->get('add_feature_id')!= 0){
                $this->AddSubscriptionToBid($workingBid,$member,$request);
            }

            if ($request->query->get('remove_feature_id')!= 0){
                $this->RemoveSubscriptionFromBid($workingBid,$member,$request);
            }
            if ($request->query->get('goTo_summary')== 1){
                //
                $this->gotoSummary($workingBid,$request);
            }
            if ($request->query->get('ignoreMilestone')== 1){
                //
                $this->ignoreMilestone($workingBid,$request);
            }
            if ($request->query->get('deleteToRebid')== 1){

                $this->redo($workingBid,$request);
            }
            if ($request->query->get('confirmBid')== 2){
               // return new JsonResponse($this->generateUrl('homepage'));
                 $this->confirmBid($member,$workingBid,$request);
            }
        }

        return  $this->render('member/project/bid.html.twig',array(
            'form' => $form ->createView(),

            'milestoneForm'=>$milestoneForm->createView(),
            'project'=>$project,
            'subscriptions'=> $bidSubscription,
            'bids'=>$bids,
            'bid_count'=>$bid_count,
            'workingBid'=>$workingBid,
            'bidValue'=>$bidValue,
        ));
    }




}