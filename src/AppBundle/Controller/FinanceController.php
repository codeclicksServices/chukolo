<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * this is responsible for anything that has to do with finance.
 *
 * @Route("finance")
 */
class FinanceController extends Controller
{

    /**
     * entities.
     *
     * @Route("/", name="finance_dashboard")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();

        return $this->render('member/user/finance/index.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }
    /**
     * entities.
     *
     * @Route("/transaction/history", name="transaction_history")
     */
    public function transactionHistoryAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();

        return $this->render('member/user/finance/history.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }
    /**
     * entities.
     *
     * @Route("/payment/verification", name="verify_payment")
     */
    public function verifyPaymentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();

        return $this->render('member/user/finance/verification.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }

    /**
     * entities.
     *
     * @Route("/fund/deposit", name="deposit_fund")
     */
    public function depositFundAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();

        return $this->render('member/user/finance/deposit.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }


    /**
     * entities.
     *
     * @Route("/fund/withdrawal/", name="withdraw_fund")
     */
    public function withdrawFundFundAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();

        return $this->render('member/user/finance/withdrawal.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }



}
