<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Util\LegacyFormHelper;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class MemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder

            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),
                array('label' => 'form.email',
                    'attr'=>array("class"=>"form-control"),
                    'translation_domain' => 'FOSUserBundle')

            )


            ->add('username', null, array('label' => 'form.username','attr'=>array("class"=>"form-control"), 'translation_domain' => 'FOSUserBundle'))

            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password','attr'=>array("class"=>"form-control"),),
                'second_options' => array('label' => 'form.password_confirmation', 'attr'=>array("class"=>"form-control"),
                ),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('intention', ChoiceType::class, array(

                'choices'  => array(
                    'Hire' => 'hire',
                    'Work' => 'work',
                ),

                'mapped'=>false,
                'expanded'=>true,
                'multiple'=>false,

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
        return 'app_member';
    }
}
