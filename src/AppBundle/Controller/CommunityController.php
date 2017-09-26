<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Bid;

/**
 * community controller.
 *
 * @Route("/community")
 */
class CommunityController extends Controller
{
    /**
     * the dashboard of the community
     *
     * @Route("", name="community-dashboard")
     *
     */
    public function dashboardAction()
    {


        return $this->render('community/index.html.twig', array(

        ));
    }


    /**
     * tget trigard when a tag i selected
     *
     * @Route("", name="community-dashboard")
     *
     */
    public function browseTagAction()
    {


        return $this->render('community/index.html.twig', array(

        ));
    }


    /**
     * for reading the blog content
     *
     * @Route("article/{id}", name="article-read")
     *
     */
    public function viewArticleAction()
    {


        return $this->render('community/show.html.twig', array(

        ));
    }


    /**
     * for commenting the blog content
     *
     * @Route("/post/comment/{articleId}", name="post-comment")
     *
     */
    public function commentAction()
    {


        return $this->render('community/index.html.twig', array(

        ));
    }



    /**
     * for commenting the blog content
     *
     * @Route("/bookmark/{articleId}", name="bookmark")
     *
     */
    public function bookmarkAction()
    {

        return $this->render('community/index.html.twig', array(

        ));
    }
}
