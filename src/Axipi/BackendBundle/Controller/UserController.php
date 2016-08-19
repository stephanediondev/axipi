<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\UserManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\UserType;
use Axipi\CoreBundle\Entity\User;

class UserController extends AbstractController
{
    protected $userManager;

    public function __construct(
        UserManager $userManager
    ) {
        $this->userManager = $userManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        if(!$this->isGranted('ROLE_USERS')) {
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        if(null !== $id) {
            $user = $this->userManager->getOne(['id' => $id]);
            if($user) {
                $parameterBag->set('user', $user);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameterBag);
            case 'create':
                return $this->createAction($request, $parameterBag);
            case 'read':
                return $this->readAction($request, $parameterBag);
            case 'update':
                return $this->updateAction($request, $parameterBag);
            case 'delete':
                if($this->getUser()->getId() == $user->getId()) {
                    $this->addFlash('danger', 'access denied');
                    return $this->redirectToRoute('axipi_backend_user', []);
                }
                return $this->deleteAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('objects', $this->userManager->getList());

        return $this->render('AxipiBackendBundle:User:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, [
            'user' => $user,
            'user_connected' => $this->getUser(),
            'roles' => $this->userManager->getRoles(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->userManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_user', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:User:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        return $this->render('AxipiBackendBundle:User:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(UserType::class, $parameterBag->get('user'), [
            'user' => $parameterBag->get('user'),
            'user_connected' => $this->getUser(),
            'roles' => $this->userManager->getRoles(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->userManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_user', ['action' => 'read', 'id' => $parameterBag->get('user')->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:User:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->userManager->remove($parameterBag->get('user'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_user', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:User:delete.html.twig', $parameterBag->all());
    }
}
