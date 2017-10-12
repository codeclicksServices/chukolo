<?php

namespace AppBundle\Controller;


use AppBundle\Form\Type\ProfileMemberType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class MemberController extends Controller
{
    /**
     * @Route("/register/member", name = "member-registration")
     */
    public function registerAction(){return $this->get('pugx_multi_user.registration_manager')->register('AppBundle\Entity\Member');}


    /**
     * for handling all user settings
     * @Route("/user/m/settings", name="user_settings")
     */
    public function UserSettingsAction(Request $request)
    {
        $member=$this->getUser();
        if (!is_object($member) || !$member instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $profileForm = $this->createForm(ProfileMemberType::class, $member);

        $profileForm->handleRequest($request);



        /*handles xp submission */
        if ($profileForm->isSubmitted() && $profileForm->isValid()) {

          /*
           * check if this is the first time of updating
           * set profile updated fully to yes set profile setting score of the user to profile score */

            $em =$this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();


            return new Response(json_encode(array('status'=>'success')));
        }




        return  $this->render('member/user/settings.html.twig',array(
            'profileForm'=> $profileForm->createView(),
        ));
    }







}