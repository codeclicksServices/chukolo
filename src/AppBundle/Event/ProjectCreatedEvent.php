<?php
namespace AppBundle\Event;

use AppBundle\Entity\Project;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * The product created event is dispatched each time an product is created
 * in the system.
 * for the the listeners to carry out post product creation actions
 */
class ProjectCreatedEvent extends Event
{


    protected $project;
    private $request;
    private $response;

    public function __construct(Project $project, Request $request)
    {
        $this->project = $project;
        $this->request=$request;
    }
    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return Request
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}