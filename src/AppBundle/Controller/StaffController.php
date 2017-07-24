<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class StaffController extends Controller
{
    /**
     * @Route("/register/staff", name = "staff-registration")
     */
    public function registerAction()
    {

        return $this
            ->get('pugx_multi_user.registration_manager')
           ->register('AppBundle\Entity\Staff');
    }
}