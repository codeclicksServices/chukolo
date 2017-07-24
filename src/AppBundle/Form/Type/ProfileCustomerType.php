<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Util\LegacyFormHelper;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class ProfileCustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder

            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))

            ->add('billingAddress', 'textarea', array(
                'attr' => array('cols' => 35,
                    'rows' => 1),
                'label' => 'Billing Address'
            ))
            ->add('contactAddress', 'textarea', array(
                'attr' => array('cols' => 35,
                    'rows' => 1),
                'label' => 'Contact Address'
            ))
            ->add('phone', 'number', array('label' => ' Phone','translation_domain' => 'FOSUserBundle',))

            ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array
             ('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('state', 'text', array('label' => 'Resident State',))
            ->add('city', 'text', array('label' => 'Resident City',))
            ->add('receivePromo','choice',array(
                'label' => 'Receive Promotional Offers ',
                'choices' => array('1' => 'Yes', '0' => 'No'),

            ));

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Customer',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_customer';
    }
}
