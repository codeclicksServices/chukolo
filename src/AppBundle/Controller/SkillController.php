<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Skill;

/**
 * Skill controller.
 *
 * @Route("/skill")
 */
class SkillController extends Controller
{
    /**
     * Lists all Skill entities.
     *
     * @Route("/", name="skill_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('AppBundle:Skill')->findAll();

        return $this->render('skill/index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * Finds and displays a Skill entity.
     *
     * @Route("/{id}", name="skill_show")
     * @Method("GET")
     */
    public function showAction(Skill $skill)
    {

        return $this->render('skill/show.html.twig', array(
            'skill' => $skill,
        ));
    }
}
