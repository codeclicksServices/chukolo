<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Bid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Ajax controller.
 *
 * @Route("/ajax")
 */
class AjaxController extends Controller
{


    /**
     * get skill for category with ajax when a user select a category
     *
     * @Route("/category/skills", name="get-category-new")
     */
    public function CategorySkillAction(Request $request) {
        if (! $request->isXmlHttpRequest()) {
            throw new NotFoundHttpException();
        }
        // Get the category id
        $id = $request->query->get('category_id');
        $result = array();

        // Return a list of cities, based on the selected province
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Skill');


       if ($id>0){
        $skills = $repo->findCategorySkill($id);
          }else{
           $skills = $repo->findAll();
       }

        foreach ($skills as $skill) {
            $result[$skill->getName()] = $skill->getId();
        }
        return new JsonResponse($result);
    }



    /**
     * get project suggestion for user to select from
     *
     * @Route("/category/project/suggest", name="suggest-category-projects")
     */
    public function CategoryProjectAction(Request $request) {
        if (! $request->isXmlHttpRequest()) {
            throw new NotFoundHttpException();
        }
        // Get the category id
        $id = $request->query->get('category_id');
        $result = array();

        // Return a list of project sugestion for that category
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Project');

        $projects = $repo->findCategoryProject($id);

        foreach ($projects as $project) {
            $result[$project->getName()] = $project->getId();
        }
        return new JsonResponse($result);
    }

    /**
     * get project skills
     *
     * @Route("/category/project/suggest/skill", name="suggest-project-skills")
     */
    public function ProjectSuggestiontAction(Request $request) {
        if (! $request->isXmlHttpRequest()) {
            throw new NotFoundHttpException();
        }
        // Get the project id
        $id = $request->query->get('project_id');
        $result = array();

        // Return a list of project sugestion for that category
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Project');

        $project = $repo->find($id);

        $skills = $project->getSkill();

        foreach ($skills as $skill) {
            $result[$skill->getName()] = $skill->getId();
        }
        return new JsonResponse($result);
    }

}
