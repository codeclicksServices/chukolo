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




class ExperienceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder
            ->add('organization',  TextType::class, array(
                'attr' => array('class'=>'form-control','placeholder'=>'Organization name' ),
            ))
            ->add('position',  TextType::class, array(
                'attr' => array('class'=>'form-control','placeholder'=>'Example:Database Administrator' ),
            ))
            ->add('started',  DateType::class, array(
                'attr' => array('class'=>'form-control',"placeholder"=>"When were you hired"),
            ))
            ->add('ended',  DateType::class, array(
                'attr' => array('class'=>'form-control',"placeholder"=>"When your contract ended"),
            ))
            ->add('role', TextareaType::class, array(
                'attr' => array('class' => 'form-control',"placeholder"=>"Your Responsibilities"),

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\XP',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_xp';
    }
}
