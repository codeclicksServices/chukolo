<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Fund;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible for adding the default user role at registration
 */
class RegistrationListener implements EventSubscriberInterface
{
    private $router;
    private  $em;

    public function __construct(UrlGeneratorInterface $router, EntityManager $em)
    {
        $this->router = $router;
        $this->em = $em;
    }


    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',

        );
    }


    public function onRegistrationSuccess(FormEvent $event)
    {


      /*
       *
       * set the default settings
       * */

/*
   *
   * create fund for this user
   *
   * */
$member = $event->getForm()->getData();
         $fund= new Fund();

        $fund->setAmount(0);
        $fund->setBookBalance(0);
        $fund->setCloseUsage(1);
        $fund->setCreated(new \DateTime('now'));
        $fund->setUsableAmount(0);
        $fund->setReceived(0);
        $fund->setReserved(0);
        $fund->setPaidOutAmount(0);
        $fund->setPayout(0);
        $fund->setOwner($member);
        $fund->setStatus('created');
        $this-> em->persist($fund);
        $this-> em->flush();



        /**
         *
         * todo :set the default settings here
         * set the default settings
         *
         * get the intentions of the user
         * if the intent is is to hire create a project you want to hire for
         * if the intent  is to work  update your user entity with your
         * skills and profile then jobs available for your skill
         * will be presented to you
         *
         */
        $form = $event->getForm();

        $intention = $form['intention']->getData();


        if ($intention == 'hire'){

            $url = $this->router->generate('project_create');
            $event->setResponse(new RedirectResponse($url));

         }

        if ($intention == 'work'){

            $url = $this->router->generate('brows_jobs');
            $event->setResponse(new RedirectResponse($url));
        }

    }


}
