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




class PublicationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder

            ->add('title',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))

            ->add('publisher',  TextType::class, array(
                'attr' => array('class'=>'form-control'),
            ))

            ->add('summary', TextareaType::class, array(
                'attr' => array('class' => 'form-control',"placeholder"=>"Publication Description"),

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Publication',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_publication';
    }
}
