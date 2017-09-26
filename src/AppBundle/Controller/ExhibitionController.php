<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Bid;

/**
 * community controller.
 *
 * @Route("/show")
 */
class ExhibitionController extends Controller
{
    /**
     * the dashboard of exhibition
     *
     * @Route("", name="exhibition-dashboard")
     *
     */
    public function dashboardAction()
    {


        return $this->render('exhibition/index.html.twig', array(

        ));
    }



    /**
     * the dashboard of exhibition
     *
     * @Route("view/{id}", name="exhibition-view")
     *
     */
    public function showExhibitionAction()
    {


        return $this->render('exhibition/show.html.twig', array(

        ));
    }

}
