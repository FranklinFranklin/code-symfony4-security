<?php

namespace App\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
//     at the beginning of every request symfony will call the support method
    public function supports(Request $request)
    {

        die('authenticator is alive!!');
    }
    public function getCredentials(Request $request)
    {

    }
    public function getUser($credentials, UserProviderInterface $userProvider)
    {

    }
    public function checkCredentials($credentials, UserInterface $user)
    {

    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

    }

    protected function getLoginUrl()
    {

    }


}
