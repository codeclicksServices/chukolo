<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class BidType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
	

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('price',  IntegerType::class, array())
            ->add('deliveryDays',  IntegerType::class, array());
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bid',
        ));


    }

    /**
     * @return string
     */
    public function getName()
    {

        return 'app_bid';
    }
}
