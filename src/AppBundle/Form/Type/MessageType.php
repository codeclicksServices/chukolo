<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class MessageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
	

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder
            ->add('firstName', 'text', array('label' => 'First Name', 'attr' => array('class'=>'form-control'),))

            ->add('lastName', 'text', array('label' => 'Last Name', 'attr' => array('class'=>'form-control'),))
            ->add('email', 'email', array('label' => 'Email','attr'
            =>array('placeholder'=>'Please enter a valid email address', 'class'=>'form-control',)))
            ->add('phone', 'number', array('label' => 'Phone','attr' => array('class'=>'form-control'),))
            ->add('title', 'textarea', array(
                'attr' => array('cols' => 50,
                    'rows' => 2, 'class'=>'form-control',
                    ),
                'label' => 'Title',
            ))
            ->add('message', 'textarea', array(
                'attr' => array('cols' => 50,
                    'rows' => 10, 'class'=>'form-control',),
                'label' => 'Message',
            ))

        ->add('send', 'submit', array(
        		'label' => 'Send',
        'attr'=>array('class'=>'btn btn-g btn-info')
     
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Message',
        ));


    }

    /**
     * @return string
     */
    public function getName()
    {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_message';
    }
}
