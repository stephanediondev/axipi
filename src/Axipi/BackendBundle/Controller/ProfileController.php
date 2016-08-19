<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\UserManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ProfileType;
use Axipi\CoreBundle\Entity\User;

class ProfileController extends AbstractController
{
    protected $userManager;

    public function __construct(
        UserManager $userManager
    ) {
        $this->userManager = $userManager;
    }

    public function dispatchAction(Request $request, $action)
    {
        $parameterBag = new ParameterBag();

        $user = $this->getUser();
        $parameterBag->set('user', $user);

        switch ($action) {
            case 'read':
                return $this->readAction($request, $parameterBag);
            case 'update':
                return $this->updateAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        return $this->render('AxipiBackendBundle:Profile:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(ProfileType::class, $parameterBag->get('user'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->userManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_profile', ['action' => 'read']);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Profile:update.html.twig', $parameterBag->all());
    }
}
