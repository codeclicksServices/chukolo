<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attachment;
use AppBundle\Entity\Education;
use AppBundle\Entity\ErrorLog;
use AppBundle\Entity\Experience;
use AppBundle\Entity\Milestone;
use AppBundle\Controller\HireController;
use AppBundle\Entity\Publication;
use AppBundle\Entity\Source;
use AppBundle\Entity\XP;
use AppBundle\Form\Type\AttachmentType;
use AppBundle\Form\Type\EducationType;
use AppBundle\Form\Type\ExperienceType;
use AppBundle\Form\Type\MilestoneType;
use AppBundle\Form\Type\PublicationType;
use AppBundle\Form\Type\SourceType;
use FOS\UserBundle\Controller\ProfileController as baseProfiler;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends baseProfiler
{

    /*
     * the order of the profile controller
     * 0 user home /dashboard
     * 1 my  profile
     * 1 their profile
     * 2 user project
     *
     *
     */

    /*
     * 0 user  home
     */

    /**
     * @Route("/dashboard", name="user_dashboard")
     */
    public function showDashboardAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('member/user/index.html.twig', array(
            'user' => $user,
        ));
    }



    /*
     * 1 user  home
     */

    /**
     * @Route("/u/{userName}.profile", name="my_profile")
     */
    public function viewMyProfileAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $Category= $this->getDoctrine()->getRepository('AppBundle:Category');
          $categories = $Category->findAll();

        $education = new Education();
        $xp= new XP();
        $publication= new Publication();
        //

        $publicationForm = $this->createForm(PublicationType::class, $publication);
        $educationForm = $this->createForm(EducationType::class, $education);
        $xpForm = $this->createForm(ExperienceType::class, $xp);

        $educationForm->handleRequest($request);
        $xpForm->handleRequest($request);
        $publicationForm->handleRequest($request);


        /*handles xp submission */
        if ($xpForm->isSubmitted() && $xpForm->isValid()) {

            $xp->setOwner($user);

            $em =$this->getDoctrine()->getManager();
            $em->persist($xp);
            $em->flush();


            return new Response(json_encode(array('status'=>'success')));
        }

        /*handles education submission */
        if ($educationForm->isSubmitted() && $educationForm->isValid()) {

            $education->setOwner($user);

            $em =$this->getDoctrine()->getManager();
            $em->persist($education);
            $em->flush();


            return new Response(json_encode(array('status'=>'success')));
        }

        /*handles education submission */
        if ($publicationForm->isSubmitted() && $publicationForm->isValid()) {

            $publication->setOwner($user);

            $em =$this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();


            return new Response(json_encode(array('status'=>'success')));
        }




        return $this->render('member/user/profile/index.html.twig', array(
            'user' => $user,
            'educationForm'=> $educationForm->createView(),
            'xpForm'=> $xpForm->createView(),
            'publicationForm'=> $publicationForm->createView(),
           'categories'=>$categories,
        ));
    }

    /*
       * 1 user  home
       */

    /**
     * @Route("/dashboard/services/my-services", name="brows_user_services")
     */
    public function viewMyServicesAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('member/user/profile/services.html.twig', array(
            'user' => $user,
        ));
    }

    /*
       * 1 user  home
       */

    /**
     * @Route("/dashboard/services/show/{serviceId}", name="show-service")
     */
    public function showServicesAction($serviceId)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('member/user/profile/show-services.html.twig', array(
            'user' => $user,
        ));
    }

    /*
           * 1 user  home
           */

    /**
     * @Route("/dashboard/services/u/show/{serviceId}", name="show-my-services")
     */
    public function showMyServicesAction($serviceId)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('member/user/profile/show-my-services.html.twig', array(
            'user' => $user,
        ));
    }


    /*
    * 1 user  home
    */

    /**
     * used for view 3rd party profile
     * i.e profile from post exhibition
     * blog chat etc
     * @Route("/dashboard", name="user_dashboard")
     */
    public function viewHisProfileAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('member/user/index.html.twig', array(
            'user' => $user,
        ));
    }

    /*
      * 2 user  project
      */


    /**
     * @Route("/dashboard/projects", name="brows_user_project")
     */
    public function userProjectIndex(Request $request)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /**
         * project repo view all project posted by user and display it
         */
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $Bid= $this->getDoctrine()->getRepository('AppBundle:Bid');

        /*
         * paginator to use*/
        $paginator  = $this->get('knp_paginator');
          //default page limit
         $pageLimit= 5;

      /*
       * project pagination queries (i.e what actually get to the front end)
       * todo on creation the project is pending on moderated it becomes visible
       */
        $pastProjectsQuery =$Project->findMyProject($user,'completed');
        $workingProjectsQuery =$Project->findMyProject($user,'ongoing');
        $openProjectsQuery =$Project->findMyProject($user,'open');
        $pendingProjects=$Project->findMyProject($user,'pending');


        $reviewingBidQuery =$Bid->findMyUnreviewedBid($user);
        $myAwardedBid = $Bid->findMyAwardedBid($user);



        $activeBidsQuery = $Bid->findMyBid($user,'created');
        $currentWorksQuery = $Bid->findMyBid($user,'progress');
        $doneJobsQuery = $Bid->findMyBid($user,'completed');





        /*
         * pagination (i.e what actually get to the front end)
         */
        $openProjects = $paginator->paginate($openProjectsQuery,$request->query->getInt('page', 1),$pageLimit);
        $workingProjects = $paginator->paginate($workingProjectsQuery,$request->query->getInt('page', 1),$pageLimit);
        $pastProjects = $paginator->paginate( $pastProjectsQuery,$request->query->getInt('page', 1),$pageLimit);

        $activeBids = $paginator->paginate($activeBidsQuery,$request->query->getInt('page', 1),$pageLimit);
        $currentWorks = $paginator->paginate($currentWorksQuery,$request->query->getInt('page', 1),$pageLimit);
        $doneJobs = $paginator->paginate($doneJobsQuery,$request->query->getInt('page', 1),$pageLimit);
        $reviewingBids = $paginator->paginate($reviewingBidQuery,$request->query->getInt('page', 1),$pageLimit);



        return  $this->render('member/user/project/index.html.twig',array(
            'openProjects'=>$openProjects,
            'workingProjects'=>$workingProjects,
            'pastProjects'=>$pastProjects,
            'activeBids'=>$activeBids,
            'currentWorks'=>$currentWorks,
            'doneJobs'=>$doneJobs,
            'reviewingBids'=>$reviewingBids,
            'myAwardedBid'=>$myAwardedBid,
            'pendingProject'=>$pendingProjects
        ));
    }


    /**
     * this is for managing your own project as an employer
     * @Route("/dashboard/projects/{id}", name="manage_user_project")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function manageProject(Request $request,$id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /*
         * milestone form
         */

        $milestone = new Milestone();

        $milestoneForm = $this->createForm(MilestoneType::class,$milestone );
        $milestoneForm->handleRequest($request);
        if ($milestoneForm->isSubmitted() && $milestoneForm->isValid()) {}

        /**
         * view all project posted by user and display it
         */
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $Bid= $this->getDoctrine()->getRepository('AppBundle:Bid');
        $project=$Project->find($id);
        $bookMarked=$Bid->findBookMarkedProposal($project);
        $awardedProposal=$Bid->findAwardedProposal($project);

        if ($request->query->get('acceptDeliverable')== 1){

            return  $this->acceptDeliverable($request);
        }
        if ($request->query->get('releaseMilestonePayment') == 1){

           return  $this->ReleaseMilestonePayment($request);
        }

        return  $this->render('member/user/project/show.html.twig',array(
            'project'=>$project,
            'bookMarkedProposals'=>$bookMarked,
            'awardedProposal'=>$awardedProposal,
            'milestoneForm'=>$milestoneForm->createView(),
        ));
    }

    /**
     * this is for managing your contract contract in this case is your bid
     * @Route("/dashboard/contracts/my/{contractId}", name="manage_contract")
     * @param Request $request
     * @param $contractId
     * @return Response
     */
    public function manageContract(Request $request,$contractId)
    {
          $Contract=$this->getDoctrine()->getRepository('AppBundle:Bid');
        /*todo don't just find with the selected input check that this user actually have this awarded project */
        $contract =$Contract->find($contractId);

          $source  = new Source();
           $attachment= new Attachment();
          $urlForm  = $this->createForm(SourceType::class,$source);
          $attachmentForm = $this->createForm(AttachmentType::class,$attachment);
          $urlForm->handleRequest($request);
        $attachmentForm->handleRequest($request);

        if ($urlForm->isSubmitted() && $urlForm->isValid()) {
            $source->setContract($contract);
            $this->persistData($source);
            // initiate the project source
            if ($contract->getInitiateSource() == false){
                $contract->setInitiateSource(true);
                $this->persistData($contract);
            }

        }

        if ($attachmentForm->isSubmitted() && $attachmentForm->isValid()) {
            $attachment->setCreated(new \DateTime("now"));
            $attachment->setContract($contract);
            $this->persistData($attachment);
        }

        if ($request->query->get('startMilestone')== 1){
            return  $this->startMilestone($contractId,$request);
        }

        if ($request->query->get('deliverableComplete')== 1){

         return  $this->completeDeliverable($contractId,$request);
         }

        return  $this->render('member/user/project/contract.html.twig',array(
            'contract'=>$contract,
            'urlForm'=>$urlForm->createView(),
            'attachmentForm'=>$attachmentForm->createView()
        ));
    }



    /**
     * this is for accepting a contract
     * @Route("/dashboard/contracts/accept/{contractId}", name="accept_contract")
     */
    public function acceptContract(Request $request,$contractId)
    {
        $Contract=$this->getDoctrine()->getRepository('AppBundle:Bid');
        $ProjectClause=$this->getDoctrine()->getRepository('AppBundle:ProjectClause');
        /* todo don't just find with the selected input check that this user actually have this awarded project */
        $contract =$Contract->find($contractId);
        $agreement=$ProjectClause->findFixedClause();

        if ($request->query->get('accept') == 71){
          $this->Accept($contract,$request);
        }



        return  $this->render('member/user/project/confirmation/accept-contract.html.twig',array(
            'contract'=>$contract,
            'agreement'=>$agreement
        ));
    }


      /* for accepting contract */
    protected  function  Accept($contract,$request){

        /*
       * check that it is a valid request
      */
        $actionCheck = $request->query->get('accept');
        switch ($actionCheck) {
            case 71:

                $project = $contract->getProject();

                //makes sure its not deleted
                if ($project->getDeleted() == false) {

                    if ($contract->getAcceptOffer() == true) {
                        //project is deleted
                        return new Response(json_encode(array('status' => 'Offer already accepted')));
                    } else {
                        $project->setState("ongoing");
                        $project->setBiddable(false);
                        $project->setOnGoing(true);
                        $project->setPrice($contract->getPrice());
                        $this->persistData($project);


                        $contract->setState("contract");
                        $contract->setStage("progress");
                        $contract->setAcceptOffer(true);
                        $this->persistData($contract);
                        /* now convert the milestone proposal to milestone */

                        if ($contract->getMilestoneProposal() != null) {

                            foreach ($contract->getMilestoneProposal() as $proposal) {
                                $milestone = new Milestone();

                                $milestone->setDescription($proposal->getDescription());
                                $milestone->setStatus("pending");
                                $milestone->setComplete(false);
                                $milestone->setStart(false);
                                $milestone->setReleasePayment(false);
                                $milestone->setContract($contract);
                                $milestone->setName($proposal->getMilestoneCode());
                                $milestone->setPrice($proposal->getAmount());

                                //transfer the deliverable from proposal to milestone

                                if ($proposal->hasDeliverable() != false) {
                                    foreach ($proposal->getDeliverable() as $deliverable) {
                                        $milestone->addDeliverable($deliverable);
                                    }
                                }
                                $this->persistData($milestone);
                            }
                        }
                        return new JsonResponse($this->generateUrl('manage_contract',
                            array('contractId' => $contract->getId())));
                    }

                } else {
                    //project is deleted
                    return new Response(json_encode(array('status' => 'This project have been deleted')));
                }


            default:
                return new Response(json_encode(array('status' => 'error occurred invalid request')));
        }
    }




}