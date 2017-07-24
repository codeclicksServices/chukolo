<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
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


        /**
         *
         */

        return  $this->render('member/user/settings.html.twig',array(

        ));
    }







}