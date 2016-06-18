<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function indexAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $parameters = new ParameterBag();
        $parameters->set('error', $authenticationUtils->getLastAuthenticationError());
        $parameters->set('lastUsername', $authenticationUtils->getLastUsername());

        $response = $this->render('AxipiBackendBundle::login.html.twig', $parameters->all());
        if($parameters->get('error')) {
            $response->setStatusCode(401);
        }
        return $response;
    }
}
