<?php

namespace AppBundle\Controller\admin;
use AppBundle\Entity\Category;
use AppBundle\Entity\Department;
use AppBundle\Form\Type\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends Controller
{
    /**
     * @Route("/admin/category/create", name="create category")
     */
    public function categoryCreateAction(Request $request)
    {




        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category)
            ->add('department','entity', array(
                'class'=>'AppBundle:Department',
                'property'=>'name',
            ))
            ->add('save', 'submit', array(
                'label' => 'Save',
                'attr'=>array('class'=>'btn btn-md btn-info')
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            // am using the id as position until i upgrade to generating new position
            $curPosition = $category->getId();
            $category->setPosition( $curPosition);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirect($this->generateUrl('create category'));
        }

        return $this->render('admin/category.html.twig', array(
            'form' => $form ->createView(),
        ));
    }
}