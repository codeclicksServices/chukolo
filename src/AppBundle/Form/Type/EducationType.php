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




class EducationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder

            ->add('school',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('degree',  TextType::class, array(
                'attr' => array('class'=>'form-control','placeholder'=>"eg: Bachelor's" ),
            ))
            ->add('department',  TextType::class, array(
                'attr' => array('class'=>'form-control','placeholder'=>'eg: Business' ),
            ))


            ->add('grade',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('started',  DateType::class, array(
                'years' => range(date('Y'), date('Y')-30),
                'widget' => 'choice',

                'attr' => array('class'=>'form-control',"placeholder"=>"Start Year"),


            ))
            ->add('ended',  DateType::class, array(
                'attr' => array('class'=>'form-control',"placeholder"=>"End Year"),
            ))
            ->add('note', TextareaType::class, array(
                'attr' => array('class' => 'form-control',"placeholder"=>"Activities & Societies (optional)"),

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Education',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_education';
    }
}
