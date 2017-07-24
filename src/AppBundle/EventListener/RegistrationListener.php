<?php
namespace AppBundle\EventListener;

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

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }


    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',

        );
    }


    public function onRegistrationSuccess(FormEvent $event)
    {

        /**
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

            $url = $this->router->generate('admin');
            $event->setResponse(new RedirectResponse($url));
        }

    }


}
