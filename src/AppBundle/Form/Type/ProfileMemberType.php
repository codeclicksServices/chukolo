<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Util\LegacyFormHelper;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class ProfileMemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder



            ->add('profession',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('firstName',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('lastName',  TextType::class, array(
                'attr' => array('class'=>'form-control','placeholder'=>"eg: Bachelor's" ),
            ))
            ->add('city',  TextType::class, array(
                'attr' => array('class'=>'form-control','placeholder'=>'eg: Business' ),
            ))
            ->add('province',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('country',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('company',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))
            ->add('gender', ChoiceType::class, array(

                'choices'  => array(
                    'Male' => 'male',
                    'Female' => 'female',
                ),

                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>false,
                'attr' => array('class'=>'form-control'),

            ))
            ->add('address', TextareaType::class, array(
                'attr' => array('class' => 'form-control',"placeholder"=>"Residential Address"),

            ))

            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'form-control','cols' => 77,'rows' => 7,"placeholder"=>"Sell your self to get more jobs"),

            ));
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Member',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_profile_update';
    }
}
