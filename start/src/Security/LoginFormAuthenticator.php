<?php

namespace App\Security;


use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

    private UserRepository $userRepository;
    private RouterInterface $router;

    public function __construct(UserRepository $userRepository, RouterInterface $router)
{
    $this->userRepository = $userRepository;
    $this->router = $router;
}

//      at the beginning of every request symfony will call the support method.
//      supports is a listener
    public function supports(Request $request)
    {
//        app_login is the name of the function in security controller >>
//        _route checks if the url is app_login and check if method is POST and submitted
        return $request->attributes->get('_route') === 'app_login'
            && $request->isMethod('POST');
    }
//    if true? symfony will continue running the script
    public function getCredentials(Request $request)
    {
//        if you want to dump a POST you use the $request property
//        dd($request->request->all());

//        read the authentication and return them in this case NAME and PASSWORD
        return[
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
        ];

//        grab email from the page and check in de db if you have a match
    }
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
//        dd($credentials);
//        getUser will return a user $credentials or null if the user is not found
//        will now get the email
        return $this->userRepository->findOneBy(['email' => $credentials['email']]);
        // it will only continue if the email is found in the form else the script will stop
        // return a user object
    }
    public function checkCredentials($credentials, UserInterface $user)
    {
     // now we will check if the user password is matching typed in form and db !!!!
    // users in db does not have password yet, so we force a true;
        return true;

    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
//         this is to reroute after the authentication if we have a success
        return new RedirectResponse($this->router->generate('app_homepage'));
    }

    protected function getLoginUrl()
    {

    }


}