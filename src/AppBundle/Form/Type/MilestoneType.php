<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class MilestoneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder

            ->add('amount',  TextType::class, array(
                'attr' => array('class'=>'form-control',"placeholder"=>"amount"),
            ))

            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'form-control',"placeholder"=>"Describe the task to be done for here"),

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Milestone',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_milestone';
    }
}
