<?php
namespace AppBundle\Event;



/**
 * contains all the event thrown in the app locally
 */
final class AppEvent
{


    /**
     * The PROJECT_CREATED event .
     *
     * This event allows you to carry out an action after a project is created.
     *
     * @Event("AppBundle\Event\ProjectCreatedEvent")
     */
    const PROJECT_CREATED = 'project.created';


    /**
     * The CHANGE_PASSWORD_INITIALIZE event occurs when the change password process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     *
     * * @Event("AppBundle\Event\ProjectEditEvent")
     */
    const EDIT_PROJECT_INITIALIZE = 'project.edit.initialize';

   /* const STATE_CREATED    = 'created';
    const STATE_VIEWED     ='viewed';
    const STATE_APPROVED   = 'approved';
    const STATE_COMPLETE   = 'complete';
    const STATE_EXPIRE     = 'expire';
    const STATE_EDITED     = 'edited';*/

}