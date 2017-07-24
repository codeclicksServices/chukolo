<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder
            ->add('name', 'text', array('label' => 'Name','attr' => array('class'=>'form-control')))

            ->add('visible','choice',array(
                'label' => 'Status',
                'choices' => array('1' => 'Visible', '0' => 'hidden'),
                'attr' => array('class'=>'form-control')
            ))

            ->add('description', 'textarea', array(
                'attr' => array('cols' => 70,
                    'rows' => 1,'class'=>'form-control'),
                'label' => 'Description','required' => false,
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_category';
    }
}
