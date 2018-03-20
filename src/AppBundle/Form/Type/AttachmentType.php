<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class AttachmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title',  TextareaType::class, array(
                'attr' => array('class'=>'form-control',"placeholder"=>"Describe this attachment"),
            ))
            ->add('file',  FileType::class, array(
                'required' => true,
                'attr' => array('class'=>'form-control','multiple' => 'multiple',"placeholder"=>"upload an Image, a MediaFile or a Text Document")
               // 'multiple' => 'multiple'

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Attachment',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contract_Attachment';
    }
}
