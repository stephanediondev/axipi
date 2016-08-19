<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    public function indexAction()
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        $parameterBag = new ParameterBag();
        $parameterBag->set('error', $authenticationUtils->getLastAuthenticationError());
        $parameterBag->set('lastUsername', $authenticationUtils->getLastUsername());

        $response = new Response();
        if($parameterBag->get('error')) {
            $response->setStatusCode(401);
        }
        return $this->render('AxipiBackendBundle::Login/index.html.twig', $parameterBag->all(), $response);
    }
}
