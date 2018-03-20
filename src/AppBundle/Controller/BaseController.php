<?php

namespace AppBundle\Controller;


use AppBundle\Entity\ChukoloFund;
use AppBundle\Entity\ChukoloFundLog;
use AppBundle\Entity\ContractInvoice;
use AppBundle\Entity\ErrorLog;
use AppBundle\Entity\FundLog;
use AppBundle\Entity\Invoice;
use AppBundle\Entity\MilestoneProposal;
use AppBundle\Entity\ProjectCommissionFund;
use AppBundle\Entity\ProjectInvoice;
use AppBundle\Entity\ReservedFund;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


class BaseController extends Controller
{
    protected function createContractInvoice($contract,$paid){
        //todo currency = app currency ut now let it be ngn
        $invoice = new ContractInvoice();
        $invoice->setTotal($contract->getPrice());
        $invoice->setReceiver($contract->getProject()->getMember());
        $invoice->setStatus("on going");
        $invoice->setCreated(new \DateTime('now'));
        $invoice->setCurrency("ngn");
        $invoice->setPayer($contract->getMember());
        $invoice->setPaid($paid);
        $invoice->setBalance($contract->getPrice());
        $invoice->setContract($contract);

        if($contract->getMilestone() != null){
            foreach ($contract->getMilestone() as $task){
                //here you are creating the relationship with the children

                $task->setInvoice($invoice);

                /*update the paid and balance for the invoice */
                if($task->getPaid() == true){
                    $curPaid = $invoice->getPaid();
                    $updatedPaid =  $curPaid + $task->getPrice();
                    $invoice->setPaid($updatedPaid);

                    $curBalance = $invoice->getBalance();
                    $updatedBalance = $curBalance -$task->getPrice();
                    $invoice->setBalance($updatedBalance);

                    /* set the status of  */
                    if($updatedBalance==0){
                        $invoice->setStatus("fully paid");
                    }

                }
            }
        }

       $this->persistData($invoice);

    }
    protected function updateContractInvoice($milestone){

          $invoice=$milestone->getInvoice();



                /* update the paid and balance for the invoice */

                    $curPaid = $invoice->getPaid();
                    $updatedPaid =  $curPaid + $milestone->getPrice();
                    $invoice->setPaid($updatedPaid);

                    $curBalance =$invoice->getBalance();
                    $updatedBalance = $curBalance -$milestone->getPrice();
                    $invoice->setBalance($updatedBalance);

                    /* set the status of  */
                    if($updatedBalance == 0){
                        $invoice->setStatus("fully paid");
                    }
                    $this->persistData($invoice);

    }
    protected function createChukoloFund($amount,$description,$payer,$bid=null,$subscription=null){
       // $fund= new;

       /* $fund->setAmount($amount);
        $fund->setDescription($description);
        $fund->setCreated(new \DateTime("now"));*/
        /*todo this currency is supoz to com from the currency settings*/
   /*     $fund->setCurrency("ngn");
        $fund->setPayer($payer);*/
        /* bid here is used for the commission*/


       /* if($subscription !=null){
            $fund->setSubscription();

            if($subscription->getType()==2){
                $fund->setSource("bid_upgrade");
            }elseif ($subscription->getType()==1){
                $fund->setSource("project_upgrade");
            }
        }*/

    }


/*
 * this functions are for bid actions
 */

    protected  function  CreateBid($bid,$project,$member){
        $price = $bid->getPrice();
        $duration = $bid->getDuration();
        $durationHour=$duration*24;

        // this value is hard coded it
        // should come from the setting
        /*
          todo this value should come from the the global system settings
          todo also the freelancer get to pay 15 percent to chukolo
        */
        $commissionRate = 15;
        $commission = $price*$commissionRate/100;
        $bidValue = $price - $commission;

        $bid->setProject($project);
        //at this stage its not visible
        $bid->setVisible(0);
        /* the value is either proposal or contract*/
        $bid->setState("proposal");
        $bid->setCreated(new \DateTime('now'));
        $bid->setWithdrawn(0);
        $bid->setDurationHour($durationHour);
        $bid->setUsedHour(0);
        $bid->setRemainingHour($durationHour);
        $bid->setHasSubscriptions(0);
        $bid->setAcceptOffer(false);
        $bid->setSaved(0);
        $bid->setModerated(0);
        $bid->setStep(1);
        $bid->setStarted(false);
        $bid->setAwarded(0);
        $bid->setBookmark(0);
        $bid->setInitiateSource(0);
        $bid->setNumberOfMilestones(0);

        //this state means this bid is like a draft its not fully bod so its practically useless on less its complete
        $bid->setStage("draft");
        $bid->setValue($bidValue);
        $bid->setCommission($commission);
        $bid->setCreatedAt(new \DateTime());
        $bid->setMember($member);

        $this->persistData($bid);



        return new Response(json_encode(array('status'=>'success')));
    }


    protected function AddSubscriptionToBid($bid,$member,$request){
        $feature_id = $request->query->get('add_feature_id');
        $repo = $this->getDoctrine()->getRepository('AppBundle:Subscription');
        $feature = $repo->find($feature_id);
        $memberFund=$member->getFund();
        $featurePrice=$feature->getValue();
        /*
         *  check if the users fund is usable
        */
        if($memberFund->getCloseUsage()==false){
            /*
              * check if you have enof fund for the feature if you do add feature else take you to place you top up
            */

            if ($memberFund->getUsableAmount() >= $featurePrice ){

                /* check if there is bid first */
                if($bid != null){
                    //there is enof fund
                    //now check if you already have this feature enabled for this bid.
                    // only make withdrawal if have ot already subscribed
                    if (!$bid->hasSubscription($feature)){

                        /*
                             add the feature to this bid
                          */
                        $curSubscriptionValue=$bid->getSubscriptionsValue();

                        $updatedSubscription=$curSubscriptionValue+ $featurePrice;
                        $bid->setSubscriptionsValue($updatedSubscription);
                        $bid->addSubscription($feature);
                        $bid->setHasSubscriptions(1);

                     $this->persistData($bid);
                        /*this makes sure that the add process was successful */
                        if($bid->hasSubscription($feature)) {
                            /*
                             * now create a reserve fund object
                             */
                            $reserve = new ReservedFund();
                            $reserve->setAmount($featurePrice);
                            //why is this fund reserved ? eg 1 = milestone Payment, 2 = project upgrade and 3= bid upgrade
                            $reserve->setSource(3);
                            $reserve->setBid($bid);
                            $reserve->setSubscription($feature);
                            $reserve->setStatus("processing");
                            $reserve->setMember($member);
                            $reserve->setDescription("purchase of bid upgrade ");
                            $reserve->setCreated(new \DateTime("now"));
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($reserve);
                            $em->flush();

                            /*
                             * reserve the value of this bid
                             */
                            $updatedUsable = $memberFund->getUsableAmount() - $featurePrice;
                            $updatedReserve = $memberFund->getReserved() + $featurePrice;

                            $memberFund->setReserved($updatedReserve);
                            $memberFund->setUsableAmount($updatedUsable);

                            $em = $this->getDoctrine()->getManager();
                            $em->persist($memberFund);
                            $em->flush();

                            // create fund usage log for monitoring and accountability
                            $usage = "reserved for purchase of bid feature";
                            $description = "reserved for the purchase of " . $feature->getName() . " for bid with id = " . $bid->getId();
                            $this->CreateFundLog($featurePrice, $usage, $description, $member);

                        }



                        return new Response(json_encode(array('status'=>'success')));
                    }else{
                        return new Response(json_encode(array('failed'=>'you have already added this feature to this bid')));
                    }
                }else{
                    //bid is not
                    // create fund usage log for monitoring and accountability
                    $action="reserved for purchase of bid feature";
                    $location="bid feature add";
                    $description="attempt to add feature where the suplly bis is null";
                    $this->CreateErrorLog($action,$location,$description);
                }
            }
            else
            {
                // not enof money so redirect to the place to top up or continue the bid creation process
                // return new Response(json_encode(array('failed'=>'not enough fund')));
                /*todo: here is suppoz to take you to where you add  money*/
                return new JsonResponse($this->generateUrl('homepage'));
            }
        }else{
            //please we don't have access to your fund please contact support to resolve this
            return new Response(json_encode(array('failed'=>'fund not usable')));
        }


    }


    protected function RemoveSubscriptionFromBid($bid,$member,$request){
        $feature_id = $request->query->get('remove_feature_id');
        $repo = $this->getDoctrine()->getRepository('AppBundle:Subscription');
        $ReservedFund = $this->getDoctrine()->getRepository('AppBundle:ReservedFund');
        $feature = $repo->find($feature_id);
        $memberFund=$member->getFund();
        $featurePrice=$feature->getValue();




        if ($bid->hasSubscription($feature)){

            /*
             * delete the reservation for this feature
             */
            $fundReservation = $ReservedFund->getMyReserveFundForBid($member,$bid,$feature);

            if (!empty($fundReservation)){
                foreach ($fundReservation as $subscription){

                    // delete the reservation
                    $subscription->setStatus("deleted");
                    $subscription->setDescription("return reserved fund for the purchase of ".$feature->getName()."for bid with id = ".$bid->getId());

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($subscription);
                    $em->flush();
                }
            }

            /*
             * reserve the value of this bid
             * */
            $updatedUsable = $memberFund->getUsableAmount()+ $featurePrice;
            $updatedReserve = $memberFund->getReserved()- $featurePrice;

            $memberFund->setReserved($updatedReserve);
            $memberFund->setUsableAmount($updatedUsable);

            $em = $this->getDoctrine()->getManager();
            $em->persist($memberFund);
            $em->flush();
            // create fund usage log for monitoring and accountability
            $usage="un reserved for purchase of bid feature";
            $description="return reserved fund for the purchase of ".$feature->getName()."for bid with id = ".$bid->getId();
            $this->CreateFundLog($featurePrice,$usage,$description,$member);
            /*
               add the feature to this bid
            */
            $curSubscriptionValue=$bid->getSubscriptionsValue();

            $updatedSubscription=$curSubscriptionValue- $featurePrice;
            $bid->setSubscriptionsValue($updatedSubscription);
            $bid->removeSubscription($feature);

            $em = $this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();

            //set the has feature to false
            if (empty($bid->getSubscription()))  {
                $bid->setHasSubscriptions(0);
            }



            return new Response(json_encode(array('status'=>'success')));
        }else{
            return new Response(json_encode(array('failed'=>'you have already removed this feature from this bid')));
        }

    }

    /**
     * @return Response
     */
    protected  function  CreateOneMilestone($bid){


        // if($actionCheck==1){
        if (!empty($bid)){

           //now set the state of the bid creation
            $milestone = new MilestoneProposal();
            $milestone->setBid($bid);
            $milestone->setType("proposal");
            $milestone->setMilestoneCode("Milestone 1");
            $milestone->setStage("final");
            $milestone->setStatus("pending");
            $milestone->setAmount($bid->getPrice());
            /*todo: make this text come from settings it should use the project title */
            $milestone->setDescription("this milestone is responsible from");

            $this->persistData($milestone);
            $bid->setStep(2);
            $this->persistData($bid);

            return new Response(json_encode(array('status'=>"successful")));

        }else
        {
            return new Response(json_encode(array('status'=>"can't  find a valid bid for this project")));
        }

    }
    protected  function  gotoSummary($bid,$request){

        /*
         * check that it is a valid request
        */
        $actionCheck = $request->query->get('goTo_summary');
        if($actionCheck==1){

            if($bid != null){
                $bid->setStep(3);
                $em = $this->getDoctrine()->getManager();
                $em->persist($bid);
                $em->flush();

                return new Response(json_encode(array('status'=>'success')));
            }else{
                //return new JsonResponse($this->generateUrl('homepage'));
                return new Response(json_encode(array('failed'=>'Invalid application try again or contact support for resolution')));
            }
        }else{
            return new JsonResponse($this->generateUrl('homepage'));
            //return new Response(json_encode(array('failed'=>'wrong call')));
        }
    }

    protected  function  ignoreMilestone($bid,$request){

        /*
       * check that it is a valid request
      */
        $actionCheck = $request->query->get('ignoreMilestone');
        if($actionCheck==1) {
            //now set the state of the bid creation
            $bid->setStep(2);

            $em =$this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();
            return new Response(json_encode(array('status'=>'success')));
        }else{
            /*todo fix this its not suppoz to go to homepage */
            return new JsonResponse($this->generateUrl('homepage'));
        }
    }

    /**
     * used for starting milestone for a particular contract
     * @param $contractId
     * @param $request
     * @return JsonResponse|Response
     * @internal param $contract
     */
    protected function startMilestone($contractId,$request){

        /*
         * check that it is a valid request
         */
        $actionCheck = $request->query->get('startMilestone');
        if($actionCheck==1) {
            $milestoneId=$request->query->get('milestoneId');
            $hourDuration=$request->query->get('durationHour');
            $Milestone=$this->getDoctrine()->getRepository('AppBundle:Milestone');

            $milestone =$Milestone->find($milestoneId);
            $contract=$milestone->getContract();

            if($milestone->getStart() == false ){
                // if this the first milestone you are working on use it to start the contract
               if($contract != null){

                if($contract->getStarted() == 0){

                    $contract->setStarted(1);
                    $contract->setStartDate(new \DateTime('now'));
                    $this->persistData($contract);
                   }
               }
               /* todo this function is not test its for changing the status of the deliverable for a milestone being started to working */
                $deliverable=$milestone->getDeliverable();
                if (!empty($deliverable)){
                    foreach ($deliverable as $key=>$value){
                        $value->setStatus("working");
                    }
                    $this->persistData($deliverable);
                };


                $milestone->setStart(true);
                $milestone->setStarted(new \DateTime('now'));
                $milestone->setStatus('progress');
                if($hourDuration != null){
                    /* hours to days */
                // $raw = $hourDuration  24;
                // $explodeRaw = explode(".", $raw);

                   // $day = $explodeRaw[0];
                   // $hours= $explodeRaw[0];

                 $initDate = strtotime("+".$hourDuration." hours");
                    $deadline= date('M d, Y H:m:i', $initDate);


                   $milestone->setDeadline(new \DateTime($deadline));
                 //   $milestone->setDurationDay($day);
                    $milestone->setDurationHour($hourDuration);
                }

                $this->persistData($milestone);

                return new Response(json_encode(array('status'=>'success')));
            }else{
                //already started
                return new Response(json_encode(array('error'=>'milestone already started')));
            }
        }else{
            /*todo fix this its not suppoz to go to homepage */
            return new Response(json_encode(array('error'=>'invalid request')));
        }
    }
    protected function redo($bid,$request){
        return new JsonResponse($this->generateUrl('homepage'));
    }
    protected function CreateErrorLog($action,$location,$description){
        $log= new ErrorLog();
        $log->setAction($action);
        $log->setLocation($location);
        $log->setDescription($description);
        $log->setCreated(new \DateTime("now"));
        $this->persistData($log);
    }
    protected function CreateChukoloFundLog($amount,$reason,$inflow,$description){
        $log = new ChukoloFundLog();
        $log->setAmount($amount);
        $log->setDescription($description);
        $log->setReason($reason);
        $log->setInflow($inflow);
        $log->setCreated(new \DateTime("now"));

        $em= $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();
    }
    protected function CreateFundLog($amount,$usage,$description,$member){
        $log = new FundLog();
        $log->setAmount($amount);
        $log->setUsedReason($usage);
        $log->setDescription($description);
        $log->setCreated(new \DateTime("now"));
        $log->setMember($member);
        $em= $this->getDoctrine()->getManager();
        $em->persist($log);
        $em->flush();
    }
    protected function CreateMilestone($bid,$milestone){

        /*
       * the idea here is that a member can only create one bid for a particular project
       * since you are creating a milestone proposal for a bid it makes since to know the bid
       * to do that
       */

        if (!empty($bid)){
            if($milestone->getAmount() <= $bid->getPrice()){
                /*todo unfinished milestone creating*/
                $milestone->setBid($bid);
                $milestone->setType("proposal");
                $milestone->setStage("first");


                $em=$this->getDoctrine()->getManager();
                $em->persist($milestone);
                $em->flush();





                //now set the state of the bid creation
                $bid->setStep(2);

                $em =$this->getDoctrine()->getManager();
                $em->persist($bid);
                $em->flush();

                return new Response(json_encode(array('status'=>'success')));
            }else{
                return new Response(json_encode(array('status'=>'Your proposal must be smaller or equal to the value of your bid')));
            }
        }else{
            return new Response(json_encode(array('status'=>"can't  find a valid bid for this project")));
        }
    }
    protected function confirmBid($member,$bid,$request){

        /*
         * check that it is a valid request
         * todo:am using 2 because that is the request number passed when confirm is clicked
         * todo : also the bid has to be verified to show for award
        */
        $actionCheck = $request->query->get('confirmBid');
        if($actionCheck==2){

            if($bid != null){
                /* 1 change the bidding step to the last 4
                make the bid make the bid ready for verification
                after verification by the admin before the employer can see the bid
                2 change the status to created update the number of milestone if there was a feature purchase do the actual fund transfer here
                3 generate invoice for the transfer
                the function of the features is to place the bid in a strategic manner with the necesary badges
                send an email to the email address for chukolo
                */

                $repo = $this->getDoctrine()->getRepository('AppBundle:ReservedFund');
                $bidSubscription=$bid->getSubscription();
                if(!empty($bidSubscription) ){
                    foreach ($bidSubscription as $feature){

                        $reserved=$repo->getMyReserveFundForProcessingBidSubscription($member,$bid,$feature) ;
                        // means there is a reservation for this bid
                        if(!empty($reserved)){
                            //am getting the first element in the array because the response of this is a one object
                            $reservedFund = $reserved[0];
                            /*
                             * get member fund
                             */
                            $memberFund=$member->getFund();

                            $curBidUpgrade=$memberFund->getBidUpgrade();
                            $updateBidUpgrade=$curBidUpgrade+$reservedFund->getAmount();

                            $curReserved=$memberFund->getReserved();
                            $updateReserved=$curReserved-$reservedFund->getAmount();

                            $curBookBalance=$memberFund->getBookBalance();
                            $updateBookBalance=$curBookBalance-$reservedFund->getAmount();

                            $memberFund->setReserved($updateReserved);
                            $memberFund->setBidUpgrade($updateBidUpgrade);
                            $memberFund->setbookBalance($updateBookBalance);

                            $em = $this->getDoctrine()->getManager();
                            $em->persist($memberFund);
                            $em->flush();
                            /*
                             * create an invoice for this user for this payment
                             * todo create invoice in later
                             */

                            /* create fund for chukolo for the purchase of this feature*/
                            $this->createChukoloFund($reservedFund->getAmount(),"purchase of bid upgrade",$member,$feature);


                            /* now change the status of the reserved fund to complete*/

                            $reservedFund->setStatus("completed");

                            $em = $this->getDoctrine()->getManager();
                            $em->persist($reservedFund);
                            $em->flush();
                        }
                    }
                }
                /*
                 * update bid record
                 */
                $bid->setStep(4);
                $bid->setStage("created");
                $this->persistData($bid);


                return new JsonResponse($this->generateUrl('homepage'));
                //  return new Response(json_encode(array('status'=>'success')));
            }
            else{
                //return new JsonResponse($this->generateUrl('homepage'));
                return new Response(json_encode(array('failed'=>'Invalid application try again or contact support for resolution')));
            }
        }else{
            return new JsonResponse($this->generateUrl('homepage'));
            //return new Response(json_encode(array('failed'=>'wrong call')));
        }
    }
    protected function completeDeliverable($contractId,$request)
    {
        $deliverableId=$request->query->get("deliverableId");
        if($deliverableId !=null){
            $Repo=$this->getDoctrine()->getRepository('AppBundle:Deliverable');
            $deliverable = $Repo->find($deliverableId);
            if($deliverable){
                $deliverable->setDone(true);
                $deliverable->setStatus($deliverableId);
                //todo send mail to the employer

               $this->persistData($deliverable);
                return new Response(json_encode(array('status' => 'Successfully Completed please wait for the employer to accept it for it to be marked as done ')));
            }else{
                $this->CreateErrorLog('Deliverable completion',"manageContract. the function that generate this error is completeDeliverable(contract id    $contractId, request)","could not find the deliverable to mark as complete ");


                return new Response(json_encode(array($deliverableId)));
            }
        }else{
            return new Response(json_encode(array('status' => 'error occurred')));
        }
    }
    protected function acceptDeliverable($request)
    {
        $deliverableId=$request->query->get("deliverableId");
        $Repo=$this->getDoctrine()->getRepository('AppBundle:Deliverable');
        $deliverable = $Repo->find($deliverableId);

            if($deliverable){
                $deliverable->setDone(true);
                $deliverable->setAccept(true);
                $deliverable->setReviewed(true);
                $deliverable->setReviewedMessage("accepted");
                $deliverable->setStatus('Complete');
                $this->persistData($deliverable);
                   /* update the milestone progress and project progress*/
                $point=$deliverable->getPoint();
                $milestone=$deliverable->getMilestone();
                $curCompletionRate = $milestone->getCompletionRate();
                $completionRate=$curCompletionRate+$point;
                $milestone->setCompletionRate($completionRate);
                //if this is the deliverable that complete the milestone run milestone completion task
                if($completionRate == 100)
                {
                    $milestone->setCompletionDate(new \DateTime("now"));
                    $milestone->setStatus('awaiting-payment');
                    $milestone->setAwaitingPayment(true);

                    $project=$milestone->getContract()->getProject();
                    $curCompletionRate = $project->getCompletionRate();
                    $completionRate=$curCompletionRate+$milestone->getPoint();
                    $project->setCompletionRate($completionRate);

                    if($completionRate == 100){
                        $project->setCompleted(new \DateTime("now"));
                        $project->setState('awaiting-feedback');
                        $project->setOnGoing(false);
                    }
                    $this->persistData($project);

                    /*send an email to employer notifying them on milestone completion*/
                }
                $this->persistData($milestone);

                return new Response(json_encode(array('status' => 'Successful ')));
            }else{
                $this->CreateErrorLog('Deliverable acceptance error',"manageProject. the function that generate this error is acceptDeliverable(request)","could not find the deliverable to accept");


                return new Response(json_encode(array('status' => 'could not find the deliverable')));
            }

    }
    /*
      these functions are for hire process
    */
    protected  function  declineMilestoneProposal($bid,$request){

        /*
       * check that it is a valid request
      */
        $actionCheck = $request->query->get('declineBidProposal');
        if($actionCheck == 1) {

            $milestoneProposal =$bid->getMilestoneProposal();
            //check to see that it has proposal
            if (!empty($milestoneProposal)){
                foreach ($milestoneProposal as $proposal){
                    $proposal->setStatus("declined");
                  $this->persistData($proposal);

                }
                return new Response(json_encode(array('status'=>'success')));
            }else{
                /* todo this kind of action should be writing to log because this condition should never be true*/
                return new Response(json_encode(array('status'=>'error occurred no proposal to decline')));
            }


        }else{
            return new Response(json_encode(array('status'=>'error occurred invalid request')));
        }
    }

    protected  function  saveBid($bid,$request){

        /*
       * check that it is a valid request
      */
        $actionCheck = $request->query->get('saveBid');
        if($actionCheck == 1) {


            //check to see that it has proposal

            $bid->setSaved(1);
          $this->persistData($bid);
            return new JsonResponse($this->generateUrl('manage_user_project',
                array('id' => $bid->getProject()->getId())));


        }else{
            return new Response(json_encode(array('status'=>'error occurred invalid request')));
        }
    }

    protected  function  acceptMilestoneProposal($bid,$request){

        /*
       * check that it is a valid request
      */
        $actionCheck = $request->query->get('acceptMilestoneProposal');
        if($actionCheck == 1) {

            $milestoneProposal =$bid->getMilestoneProposal();
            //check to see that it has proposal
            if (!empty($milestoneProposal)){
                foreach ($milestoneProposal as $proposal){
                    $proposal->setType("offer");
                    $proposal->setStatus("accept");

                    $em =$this->getDoctrine()->getManager();
                    $em->persist($proposal);
                    $em->flush();
                }
                return new Response(json_encode(array('status'=>'success')));
            }else{
                /* todo this kind of action should be writing to log because this condition should never be true*/
                return new Response(json_encode(array('status'=>'error occurred no proposal to decline')));
            }


        }else{
            return new Response(json_encode(array('status'=>'error occurred invalid request')));
        }
    }


    /**
     * @param $bid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function awardProjectAction($bid)
    {


        $project=$bid->getProject();


        /*
         * award processes one project can only  be awarded one person
         */

        if(!$project->getAwarded()== 1){
            //makes sure you have not already awarded this project to this bid
            if($bid->getAwarded()==0){
                $employer =$project->getMember();
                $employerFund =$employer->getFund();

                // check to make sure the employer have fund that is more than the amount of this proposal
                $memberUsableFund = $employerFund->getUsableAmount();

                if($memberUsableFund >= $bid->getPrice()){

                    $repo = $this->getDoctrine()->getRepository("AppBundle:MilestoneProposal");

                    /* get the milestones for this bid */
                    $milestoneOffers = $repo->getBidOffers($bid);

                    /*
                     * this step makes sure there is an offer before you can award project
                     */
                    if (!empty($milestoneOffers)){
                        /*
                         * now reserve the amount of this milestone from the employer fund
                         */
                        foreach ($milestoneOffers as $milestoneOffer){
                            $offerAmount=$milestoneOffer->getAmount();

                            /*
                             * reserve from user fund
                             */
                            $curUsableFund = $employerFund->getUsableAmount();
                            $updatedUsableFund = $curUsableFund-$offerAmount;

                            $curReservedFund=$employerFund->getUsableAmount();
                            $updatedReservedFund= $curReservedFund+$offerAmount;

                            $curBookBalance=$employerFund->getBookBalance();
                            $updatedBookBalance = $curBookBalance-$offerAmount;

                            $employerFund->setUsableAmount($updatedUsableFund);
                            $employerFund->setReserved($updatedReservedFund);
                            $employerFund->setBookBalance($updatedBookBalance);

                           $this->persistData($employerFund);

                            /*
                             * create a reservation of this amount
                             */
                            $reserve = new ReservedFund();
                            $reserve->setAmount($offerAmount);
                            $reserve->setDescription("reserved for milestone payment");
                            $reserve->setSource("milestone_payment");
                            //$reserve->setMilestone($milestoneOffer);
                            $reserve->setStatus("awaiting");
                            $reserve->setCreated(new \DateTime("now"));
                            /*todo check that this is the correct member later */
                            $reserve->setMember($employer);
                           $this->persistData($reserve);

                            /*
                             * create a log for this reservation
                             */
                            $fundLog = new FundLog();
                            $fundLog->setAmount($offerAmount);
                            $fundLog->setDescription("reserved for milestone payment");
                            $fundLog->setCreated(new \DateTime("now"));
                            $fundLog->setUsedReason("milestone reservation");
                            $fundLog->setMember($employer);
                            $this->persistData($fundLog);

                        }



                        /*
                  * BID ACTION
                  * if a bid is awarded the project
                  * change  stage to awarded and leave state as proposal
                  */
                        $bid->setStage('awarded');
                        $bid->setAwarded(1);
                        $this->persistData($bid);

                        /*
                         * send email to the bidder
                         */

                        /*
                         * PROJECT ACTION
                         * if a project is awarded
                         * change  stage to awarded and leave state as proposal
                         */

                        $project->setState('awarded');
                        $project->setAwarded(1);

                        $this->persistData($project);

                        return $this->redirect($this->generateUrl('manage_user_project',
                            array('id' => $project->getId(),)));
                    }else{
                        //also this is never supoz to hapen so write to log for fixes no milestone created echo create milestone error
                    }

                }else{
                    //this should never happen because fund availability should be checked before getting here echo some message  todo write to log
                }

                /*
                 * redirect to project management
                 */

                return $this->redirect($this->generateUrl('manage_user_project',
                    array('id' => $project->getId(),)));

            }else{
                //project already awarded to this bid

                return $this->redirect($this->generateUrl('manage_user_project',
                    array('id' => $project->getId(),)));
            }
        }else{
            //project is awarded go to manage contract

            return $this->redirect($this->generateUrl('manage_user_project',
                array('id' => $project->getId(),)));
        }


    }

    /**
     * @param $data
     */
    public function persistData($data){
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
    }
    /*
     * finance
     */

    /**
     * @param $request
     * @return Response
     */
    protected function ReleaseMilestonePayment($request){

        $milestoneId=$request->query->get("milestoneId");

        if($milestoneId !=null){
            $Repo = $this->getDoctrine()->getRepository('AppBundle:Milestone');
            $ReservedFund = $this->getDoctrine()->getRepository('AppBundle:ReservedFund');
            $Invoice=$this->getDoctrine()->getRepository('AppBundle:ContractInvoice');

            $milestone=$Repo->find($milestoneId);
          if(!empty($milestone)){
            if($milestone->getPaid() == false){
                /*get the bid from the milestone*/
                $bid=$milestone->getContract();
                //todo this function (getFundReservedForBid($bid)) have not been created in reserved fund repo
                /* reserved fund for this bid */
                //source  is use to know which of the reserved fund you want to get for that bid
                $source="milestone_payment";
                $reservedFund=$ReservedFund->getFundReservedForBid($bid,$source);
                $milestonePrice=$milestone->getPrice();
                $milestoneValue=$milestone->getValue();
                $milestoneCommission=$milestone->getCommission();

                if(!empty($reservedFund)){
                    if($reservedFund->getAmount() >= $milestonePrice){
                        //take away the milestone price from the reserved fund
                        //add the milestone value to the freelancers fund
                        //add the milestone commission  to chukolo fund
                        //take away milestone price from the employer reserved fund



                        /*now pay project commission to chukolo*/
                        $chukoloFund = new ProjectCommissionFund();
                        $chukoloFund->setContract($bid);
                        $chukoloFund->setAmount($milestoneCommission);
                        /*todo currency should come from setting for internationalisation*/
                        $chukoloFund->setCurrency('ngn');
                        $chukoloFund->setDescription("project commission");
                        $chukoloFund->setCreated(new \DateTime("now"));
                        $chukoloFund->setPayer($reservedFund->getMember());
                       $this->persistData($chukoloFund);

                       $this->CreateChukoloFundLog($milestoneCommission,"project commission",true,"received commission for the project called   ".$bid->getProject()->getName()."");


                        /* action on milestone mark it as paid  */
                        $milestone->setPaid(true);
                        $milestone->setAwaitingPayment(false);
                        $milestone->setStatus("paid");
                        $milestone->setComplete(true);
                         $this->persistData($milestone);


                        /* actions on the reserved fund */
                        $curReservedAmount=$reservedFund->getAmount();
                        $updatedReservedAmount=$curReservedAmount-$milestonePrice;
                        $reservedFund->setAmount($updatedReservedAmount);
                        $this->persistData($reservedFund);

                        $freelancerFund=$bid->getMember()->getFund();
                        /* actions on the employee fund */
                        $employerFund=$reservedFund->getMember()->getFund();

                        $curEmployeeReservedAmount = $employerFund->getReserved();
                        $updatedEmployeeReservedAmount=$curEmployeeReservedAmount-$milestonePrice;
                        $employerFund->setReserved($updatedEmployeeReservedAmount);


                        $curEmployeeProjectPayment=$employerFund->getProjectPayment();
                        $updatedEmployeeProjectPayment=$curEmployeeProjectPayment+$milestonePrice;
                        $employerFund->setProjectPayment($updatedEmployeeProjectPayment);

                        $curEmployeeBookBalance= $employerFund->getBookBalance();
                        $updatedEmployeeBookBalance = $curEmployeeBookBalance-$milestonePrice;
                        $employerFund->setBookBalance($updatedEmployeeBookBalance);


                        $this->persistData($employerFund);

                        $this->CreateFundLog($milestonePrice,"milestone payment","paid for a completed milestone for a project",$reservedFund->getMember());


                        /* actions on the freelancer fund */
                        $curFreelancerReceived = $freelancerFund->getReceived()+0;
                        $updatedFreelancerReceived=$curFreelancerReceived+$milestoneValue;
                        $freelancerFund->setReceived($updatedFreelancerReceived);

                        $curFreelancerUsableAmount=$freelancerFund->getUsableAmount();
                        $updatedFreelancerUsableAmount=$curFreelancerUsableAmount+$milestoneValue;
                        $freelancerFund->setUsableAmount($updatedFreelancerUsableAmount);

                        $curFreelancerBookBalance=$freelancerFund->getBookBalance();
                        $updatedFreelancerBookBalance =$curFreelancerBookBalance+$milestoneValue;
                        $freelancerFund->setBookBalance($updatedFreelancerBookBalance);

                        $this->persistData($freelancerFund);
                            $this->CreateFundLog($milestoneValue,"milestone payment","received for a completed milestone in project ".$bid->getProject()->getName(),$bid->getMember());



                        return new Response(json_encode(array('status'=>'successful')));
                    }else{
                        //you have insufficient fund. fund not up to required amount this case should never happen
                        return new Response(json_encode(array('status'=>'you have insufficient fund reserved for this milestone . fund not up to required amount')));
                    }
                }else{
                    //no fund reserve for this bid
                    return new Response(json_encode(array('status'=>'no fund reserved or this contract')));
                }
            }else{
                return new Response(json_encode(array('status'=>'this milestone has been paid for')));
            }
          }else{
              return new Response(json_encode(array('status'=>'cannot find this milestone')));
          }

        }else{
            return new Response(json_encode(array('status'=>'cannot find this milestone id')));
        }
    }
}
