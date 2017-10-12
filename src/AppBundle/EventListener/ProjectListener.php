<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Category;
use AppBundle\Event\AppEvent;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Listener responsible for listening to project actions

 */
class ProjectListener implements EventSubscriberInterface
{
    protected $container;
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;

    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::PROJECT_CREATED =>'onCreationSuccess',
            FormEvents::POST_SUBMIT => 'onPostSubmit',
        );
    }



    public function onPostSubmit(FormEvent $event)
    {

        $form = $event->getForm();




            // this would be your entity, i.e. Project
        $project=$form->getData();;




         //$project->getId();
      $category=$project->getCategory();

               $skills = null  ? array() : $category->getSkill();

               $form->add('skill', EntityType::class, array(
                   'class'       => 'AppBundle:Skill',
                   'placeholder' => '',
                   'choices'     => $skills,
                   'attr'=>array("class"=>"form-control"),
                   'choice_label'=>'name',
                   'multiple' => true,
                   'required' => true,
                   'expanded' => false,
                   'label' => false,
               ));
           }



    /**
     * @param Event $event
     */
    public function onCreationSuccess(Event $event)
    {

        /**
         * anytime a project is created automatically redirect to dashboard/project the
         * members profile and view project detail an making it possible to update project repost od delete
         * project
         *
         */
            $url = $this->router->generate('homepagse');

            $event->setResponse(new RedirectResponse($url));
/*        $form ->add('project', EntityType::class, array(
            'class'=>'AppBundle:Project',
            'attr'=>array("class"=>"form-control"),
            'choice_label'=>'name',
            'required' => false,
            'expanded'=>false,
            'placeholder' => 'Select a Job',
            'mapped'=>false,
        ));*/

    }
}
