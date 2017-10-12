<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Bid;

/**
 * Bid controller.
 *
 * @Route("/messages")
 */
class MailboxController extends Controller
{
    /**
     * inbox actions for displaying your inbox.
     *
     * @Route("/", name="message_inbox")
     *
     */
    public function inboxAction()
    {


        return $this->render('member/user/mailbox/inbox.html.twig', array(

        ));
    }


    /**
     * inbox actions for displaying your sent.
     *
     * @Route("/sent", name="message_sent")
     *
     */
    public function sentAction()
    {


        return $this->render('member/user/mailbox/sent.html.twig', array(

        ));
    }
    /**
     * inbox actions for displaying your archived messages.
     *
     * @Route("/archived", name="message_archived")
     *
     */
    public function archivedAction()
    {


        return $this->render('member/user/mailbox/archived.html.twig', array(

        ));
    }
    /**
     * inbox actions for displaying your draft messages.
     *
     * @Route("/draft", name="message_draft")
     *
     */
    public function draftAction()
    {

        return $this->render('member/user/mailbox/draft.html.twig', array(

        ));
    }

    /**
     * inbox actions for displaying your draft messages.
     *
     * @Route("/all", name="message_all")
     *
    */
    public function allAction()
    {

        return $this->render('member/user/mailbox/all.html.twig', array(

        ));
    }
    /**
     * inbox actions for displaying your writing a new message.
     *
     * @Route("/compose", name="message_compose")
     *
     */
    public function composeAction()
    {

        return $this->render('member/user/mailbox/compose.html.twig', array(

        ));
    }
}
