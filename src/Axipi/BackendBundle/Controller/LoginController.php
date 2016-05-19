<?php

namespace Axipi\BackendBundle\Controller;

use Axipi\CoreBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function indexAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $parameters = [];

        // get the login error if there is one
        $parameters['error'] = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AxipiBackendBundle::login.html.twig', $parameters);
    }
}
