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
        $parameters = new ParameterBag();

        $user = $this->getUser();
        $parameters->set('user', $user);

        switch ($action) {
            case 'read':
                return $this->readAction($request, $parameters);
            case 'update':
                return $this->updateAction($request, $parameters);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_profile', []);
    }

    public function readAction(Request $request, ParameterBag $parameters)
    {
        return $this->render('AxipiBackendBundle:MaterialDesignLite/Profile:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters)
    {
        $form = $this->createForm(ProfileType::class, $parameters->get('user'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->userManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_profile', ['action' => 'read']);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:MaterialDesignLite/Profile:update.html.twig', $parameters->all());
    }
}
