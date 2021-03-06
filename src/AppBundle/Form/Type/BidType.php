<?php

namespace AppBundle\Form\Type;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('price',  IntegerType::class, array(
                'attr'=>array("class"=>"form-control form-control-rounded form-control-air","placeholder"=>"You would receive"),
                'label' => false,
            ))
            ->add('duration',  IntegerType::class, array(
                'attr'=>array("class"=>"form-control form-control-rounded form-control-air","placeholder"=>"Deliver in days"),
                'label' => false,
            ))
            ->add('proposal', TextareaType::class, array(
                'attr' => array('class' => 'form-control-line has-success',
                    "placeholder"=>"Describe why you should be awarded this project",'cols' => 77,'rows' => 7),
                'label' => false,
            ))
            //on select it should updte the numberOfMilestones to this number
           /*
            *  ->add('numberMilestoneProposal',ChoiceType::class,array(
                'label' => false,
                'required' => true,
                'choices' => array(
                    '1 Milestone' => '1',
                    '2 Milestones' => '2'),
                'mapped'=>false,
                'attr' => array('class'=>'form-control')
            ))*/
           /*
            *  ->add('subscription', EntityType::class, array(
                'class'=>'AppBundle:Subscription',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->where('s.type = :bid')
                        ->setParameter('bid', 2);
                },
                'attr'=>array("class"=>""),
                'required' => false,
                'choice_label'=>'name',
                'expanded'=>true,
                'multiple'=> true,
                'label' => false,
            ))*/;
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
