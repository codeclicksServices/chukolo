<?php
namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener responsible for adding the default user role at registration
 */
class UserUpdateListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::PROFILE_EDIT_SUCCESS => 'onProfileUpdateSuccess',
        );
    }

    public function onProfileUpdateSuccess(FormEvent $event)
    {
        $user = $event->getForm()->getData();

        $user->setUpdated(1);
    }
}
