<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Category;


//not that you have to import the entity manager to your form
use AppBundle\Entity\Project;
use Doctrine\ORM\EntityManager;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;




use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */

class ProjectType extends AbstractType
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {




        $builder

               ->add('project', EntityType::class, array(
                   'class'=>'AppBundle:Project',
                   'attr'=>array("class"=>"form-control",'hidden'=>true,),
                   'choice_label'=>'name',
                   'required' => false,
                   'expanded'=>false,
                   'mapped'=>false,
                   'label' => false,
                   'placeholder' => 'Select a Project(optional)',
               ))
                ->add('name',  TextType::class, array(
                    'attr' => array('class'=>'form-control','placeholder'=>'Project name e.g Paint a house' ),
                    ))
                ->add('type', ChoiceType::class, array(
                    'choices' => array('Fixed Project' => '1'),
                    'expanded'=>true,
                    'label' => false,
                ) )
                ->add('budget', EntityType::class, array(
                         'class'=>'AppBundle:Budget',
                    'attr'=>array("class"=>"form-control"),
                         'choice_label'=>'budgetname'
                     ))

                ->add('description', TextareaType::class, array(
                    'attr' => array('class' => 'form-control',"placeholder"=>"Describe your project here"),

                 ))
                ->add('documentFile', FileType::class, array(
                    'required' => false,
                ))
                ->add('subscription', EntityType::class, array(
                    'class'=>'AppBundle:Subscription',
                    'attr'=>array("class"=>"form-control"),
                    'required' => false,
                    'choice_label'=>'name',
                    'expanded'=>true,
                    'multiple'=> true,
                    'label' => false,
                ));


        // Add listeners
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));



    }
    protected function addElements(FormInterface $form, Category $category = null, Project $project = null) {


     //   $skills = $this->em->getRepository('AppBundle:Skill')->findAll();

          // Add the category element
        $form->add('category', EntityType::class, array(
            'class'=>'AppBundle:Category',
            'attr'=>array("class"=>"form-control"),
            'choice_label'=>'name',
            'required' => false,
            'expanded'=>false,

            'data' => $category,
            'placeholder' => 'Choose a category (optional)',
        ));


        // For the sake of this project all the skills are presented to you if you
        // did not choose any particular category
        $skills = $this->em->getRepository('AppBundle:Skill')->findAll();



        //this would happen when the user selects a category
        if ($category) {

          /*things to do when a user selects category
          1 get the skills for that category
          2 get the project sugestion for that category
          3 if the project is selected populate the name of the project and set the skills for that project to the selected skills
          4 if the category is a local job add location detector */


            // Fetch the skills for the selected category
            $repo = $this->em->getRepository('AppBundle:Skill');

            $skills = $repo->findCategorySkill($category, array('name' => 'asc'));
        }

        //add the skills
        $form->add('skill', EntityType::class, array(
            'class'=>'AppBundle:Skill',
            //pass in the skills gotten as choice
            'choices' => $skills,
            'attr'=>array("class"=>"form-control"),
            'choice_label'=>'name',
            'placeholder' => 'What skills are required for this job?',
            'multiple' => true,
            'required' => true,
            'expanded' => false,
            'label' => false,

        ));


    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Note that the data is not yet hydrated into the entity.

        $category =$this->em->getRepository('AppBundle:Category')->find($data['category']);

        $this->addElements($form, $category);
    }


    function onPreSetData(FormEvent $event) {
        $project = $event->getData();
        $form = $event->getForm();


        // We might have an empty account (when we insert a new account, for instance)
        $category = $project->getCategory();

        $this->addElements($form, $category);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project',
        ));
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'app_project';
    }


}
