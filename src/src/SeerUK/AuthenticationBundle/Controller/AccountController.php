<?php

/**
 * Advanced Web Development - Authorisation
 *
 * @author  Elliot Wright <wright.elliot@gmail.com>
 * @since   2014
 * @package AdvWeb-Auth
 */

namespace SeerUK\AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Account Controller
 */
class AccountController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('SeerUKAuthenticationBundle:Login:login.html.twig', array(
            'error'         => $error,
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'pageTitle'     => 'Login',
            'referer'       => $request->headers->get('referer'),
        ));
    }

    public function homeAction()
    {
        return $this->render('SeerUKAuthenticationBundle:Home:index.html.twig');
    }

    public function adminAction()
    {
        return $this->render('SeerUKAuthenticationBundle:Admin:index.html.twig');
    }
}
