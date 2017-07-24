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
 * Project controller.
 */
class ProjectController extends Controller
{



    /**
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
            $project->setVisible(1);
            $project->setState('pending');
            $project->setMember($user);

            /*
            acctions that takes place on project creation
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
    * @Route("/jobs/", name="brows jobs")
     */
    public function IndexAction(Request $request)
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
            $bid->setState("created");
            $bid->setValue($bidValue);
            $bid->setCommission($commission);
            $bid->setCreatedAt(new \DateTime());
            $bid->setMember($member);
                   //some  actions happens before or after  you place bid
            $em =$this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();
                 //included events that is handle on bid creation
        }

        return  $this->render('project/show.html.twig',array(
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