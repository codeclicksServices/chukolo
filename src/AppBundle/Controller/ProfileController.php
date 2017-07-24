<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as baseProfiler;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends baseProfiler
{

    /*
     * the order of the profile controller
     * 0 user home /dashboard
     * 1 user project
     * */




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

        /*
         * paginator to use*/
        $paginator  = $this->get('knp_paginator');
          //default page limit
         $pageLimit= 2;






      /*
       * project pagination queries (i.e what actually get to the front end)
       */
        $pastProjectsQuery =$Project->findMyProject($user,'past');
        $workingProjectsQuery =$Project->findMyProject($user,'awarded');
        $openProjectsQuery =$Project->findMyProject($user,'open');

       /*
        * paginationgs (i.e what actually get to the front end)
        */
        $openProjects = $paginator->paginate($openProjectsQuery,$request->query->getInt('page', 1),$pageLimit);
        $workingProjects = $paginator->paginate($workingProjectsQuery,$request->query->getInt('page', 1),$pageLimit);
        $pastProjects = $paginator->paginate( $pastProjectsQuery,$request->query->getInt('page', 1),$pageLimit);

        return  $this->render('member/user/project/index.html.twig',array(
            'openProjects'=>$openProjects,
            'workingProject'=>$workingProjects,
            'pastProject'=>$pastProjects,
        ));
    }





    /**
     * this is for managing your own project as an employer
     * @Route("/dashboard/projects/{id}", name="manage_user_project")
     */
    public function manageProject(Request $request,$id)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /**
         * view all project posted by user and display it
         */
        $Project= $this->getDoctrine()->getRepository('AppBundle:Project');
        $project=$Project->find($id);

        return  $this->render('member/user/project/show.html.twig',array(
            'project'=>$project,
        ));
    }

    /**
     *for awarding project to the freelancer
     * @Route("/project/award/{projectId}/", name="award project")
     */
    public function ProjectAwardAction(Request $request)
    {

        /**
         * view all the bids for a particular project
         * award the project to the bider of your choice
         */

        return  $this->render('default/award.html.twig',array());
    }




}