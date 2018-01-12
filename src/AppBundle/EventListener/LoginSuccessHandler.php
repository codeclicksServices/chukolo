<?php
namespace AppBundle\EventListener;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $authorizationChecker;

    public function __construct(Router $router, AuthorizationChecker $authorizationChecker)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        $response = null;

     /*   if (($this->authorizationChecker->isGranted('ROLE_SUPPORT')) ||
            ($this->authorizationChecker->isGranted('ROLE_DEVELOPER')))
        {
            $response = new RedirectResponse($this->router->generate('admin'));
        }*/
     /*todo please correct the role to ROLE_MEMBER when you can delete the current users */
        if ($this->authorizationChecker->isGranted('ROLE_ MEMBER')) {
        $response = new RedirectResponse($this->router->generate('user_dashboard'));
        }else{
            $response = new RedirectResponse($this->router->generate('homepage'));        }
        return $response;
    }
}