<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\ItemManager;
use Axipi\CoreBundle\Manager\RelationManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\RelationType;
use Axipi\CoreBundle\Entity\Item;
use Axipi\CoreBundle\Entity\Relation;

class RelationController extends AbstractController
{
    protected $itemManager;

    protected $relationManager;

    public function __construct(
        ItemManager $itemManager,
        RelationManager $relationManager
    ) {
        $this->itemManager = $itemManager;
        $this->relationManager = $relationManager;
    }

    public function dispatchAction(Request $request, $language, $action, $id)
    {
        if(!$this->isGranted('ROLE_WIDGETS')) {
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $widget = $this->itemManager->getOne(['id' => $id]);
            if($widget) {
                $parameterBag->set('widget', $widget);
            } else {
                return $this->displayError(404);
            }
        } else if(null !== $id) {
            $relation = $this->relationManager->getOne(['id' => $id]);
            if($relation) {
                $parameterBag->set('relation', $relation);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'create':
                return $this->createAction($request, $parameterBag, $language);
            case 'read':
                return $this->readAction($request, $parameterBag);
            case 'update':
                return $this->updateAction($request, $parameterBag, $language);
            case 'delete':
                return $this->deleteAction($request, $parameterBag, $language);
            case 'sort':
                return $this->sortAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function createAction(Request $request, ParameterBag $parameterBag, $language)
    {
        $relation = new Relation();
        $relation->setWidget($parameterBag->get('widget'));
        $relation->setIsActive(true);

        $form = $this->createForm(RelationType::class, $relation, [
            'relation' => $relation,
            'relations' => $this->relationManager->getList(['widget' => $parameterBag->get('widget')->getId()]),
            'items' => $this->itemManager->getList(['category' => 'page']),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $id = $this->relationManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_relation', ['language' => $language, 'action' => 'read', 'id' => $id]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('relations', $this->relationManager->getList(['widget' => $parameterBag->get('relation')->getWidget()->getId(), 'parent' => $parameterBag->get('relation')->getId()]));

        return $this->render('AxipiBackendBundle:Relation:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag, $language)
    {
        $form = $this->createForm(RelationType::class, $parameterBag->get('relation'), [
            'relation' => $parameterBag->get('relation'),
            'relations' => $this->relationManager->getList(['widget' => $parameterBag->get('relation')->getWidget()->getId()]),
            'items' => $this->itemManager->getList(['category' => 'page']),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_relation', ['language' => $language, 'action' => 'read', 'id' => $parameterBag->get('relation')->getid()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag, $language)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->remove($parameterBag->get('relation'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_widget', ['language' => $language, 'action' => 'read', 'id' => $parameterBag->get('relation')->getWidget()->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:delete.html.twig', $parameterBag->all());
    }
    public function sortAction(Request $request, ParameterBag $parameterBag)
    {
        $data = json_decode($request->request->get('result'));
        foreach($data as $id => $ordering) {
            $relation = $this->relationManager->getOne(['id' => intval($id)]);
            if($relation) {
                $relation->setOrdering(intval($ordering));
                $this->relationManager->persist($relation);
            }
        }

        return new JsonResponse($data);
    }
}
