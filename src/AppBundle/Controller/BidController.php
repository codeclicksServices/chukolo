<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Bid;

/**
 * Bid controller.
 *
 * @Route("/bid")
 */
class BidController extends Controller
{
    /**
     * Lists all Bid entities.
     *
     * @Route("/", name="bid_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bids = $em->getRepository('AppBundle:Bid')->findAll();

        return $this->render('bid/index.html.twig', array(
            'bids' => $bids,
        ));
    }

    /**
     * Finds and displays a Bid entity.
     *
     * @Route("/{id}", name="bid_show")
     * @Method("GET")
     */
    public function showAction(Bid $bid)
    {

        return $this->render('bid/show.html.twig', array(
            'bid' => $bid,
        ));
    }
}
