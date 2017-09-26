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
 * Responsible for any action relating to hiring a freelancer .
 */
class HireController extends Controller
{



    /**
     * todo make sure you fix the moderated before project is made visible also make it possible for the creator to see the project
     * todo before moderation
     * @Route("/project/post/{categoryId}", name="project_create")
     */
    public function ProjectCreateAction(Request $request,$categoryId = 0)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
        }


        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project)
            ->add('save',  SubmitType::class, array(
                'label' => 'Post Project Now'
            ));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $project->setCreated(new \DateTime());
            $project->setDiscontinue(0);
            $project->setViewed(0);
            $project->setDeleted(0);
            $project->setVisible(1);
            $project->setBiddable(1);
            $project->setAwarded(1);
            $project->setModerated(0);
            $project->setOnGoing(0);
            $project->setState('pending');
            $project->setMember($user);

            /*
            actions that takes place on project creation
            1 send a mail to all the freelancers that possess the skills required for the project
            etc
            //create product created event and passed in product as the event object
            $event = new ProductCreatedEvent($product);
            // add listener to the event
            $dispatcher->addListener(ProductCreatedEvent::PRODUCT_CREATED, array($listener, 'onCreationSuccess'));
            //dispatch event
            $dispatcher->dispatch(ProductCreatedEvent::PRODUCT_CREATED, $event);*/

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $dispatcher = $this->get('event_dispatcher');
            $event = new ProjectCreatedEvent($project,$request);
            $dispatcher->dispatch(AppEvent::PROJECT_CREATED, $event);

            //if the response of the event is not null redirect to the url

            if (null === $response = $event->getResponse()) {

                $url = $this->generateUrl('manage_user_project',
                    array('id' => $project->getId(), ));
                $response = new RedirectResponse($url);
                return $response;
            }
           // $event->stopPropagation();
        }

        return  $this->render('member/user/project/create.html.twig',array(
            'form' => $form ->createView(),
        ));
    }

    /**
     *
     * @Route("/project/edit/{id}21H", name="project_edit")
     */
    public function projectEditAction(Request $request,$id){

           $em = $this->getDoctrine()->getManager();;
        $project  = $em->getRepository('AppBundle:Project')->find($id);

       /* if (is_null($id)) {
            $postData = $request->get('product');
            $id = $postData['id'];
        }*/

        $form = $this->createForm('AppBundle\Form\Type\ProjectType',  $project)


            ->add('save', SubmitType::class, array(
                'label' => 'Update My Project',
                'attr'=>array('class'=>'btn btn-md btn-info btn-outline')

            ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
              /*  $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();*/

                return $this->redirect($this->generateUrl('manage_user_project',
                    array('id' => $id,)));

        }



        return $this->render('member/user/project/edit.html.twig', array(
            'form' => $form ->createView(),
            'project'=>$project ,

        ));
    }

    /**
     * entities.
     *
     * @Route("/project/initialize/award/{proposalId}", name="initialize-project-award")
     */
    public function initializeAwardAction($proposalId)
    {
        $bid  = $this->getDoctrine()->getManager()->getRepository('AppBundle:Bid')->find($proposalId);






        return $this->render('member/milestone/index.html.twig', array(
            'bid' => $bid,
        ));
    }


    /**
      * @Route("/project/award/{proposalId}", name="award-project")
     */
    public function awardProjectAction($proposalId)
    {


        $bid  = $this->getDoctrine()->getManager()->getRepository('AppBundle:Bid')->find($proposalId);
        $project=$bid->getProject();
        /*
         * award processes one project can only  be awarded one person
         */

        if(!$project->getAwarded()== 1){
            if($bid->getAwarded()==0){

                /*
                 * BID ACTION
                 * if a bid is awarded the project
                 * change  stage to awarded and leave state as proposal
                 */
                $bid->setStage('awarded');
                $bid->setAwarded(1);
                $em = $this->getDoctrine()->getManager();
                $em->persist($bid);
                $em->flush();
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
                $em =$this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
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



    public function milestoneCreateAction($milestone,$proposalId)
    {
        $bid  = $this->getDoctrine()->getManager()->getRepository('AppBundle:Bid')->find($proposalId);


        /*
         * when mile stone create is initiated
         * check if this user has money in his chukolo account
         * if he has money in his chukolo account reserve the milestone amount for his job
         * send him a mail about the transaction
         * send the freelancer a notification about the transaction
         * if the freelancer have accepted the project mark it as started else wait for acceptance
         * */

            $milestone->setCancel(0);
            $milestone->setComplete(0);
            $milestone->setReleased(0);
            $milestone->setEmployer($bid->getProject()->getMember());
            $milestone->setContract($bid);

            $em = $this->getDoctrine()->getManager();
            $em->persist($milestone);
            $em->flush();


    }

}