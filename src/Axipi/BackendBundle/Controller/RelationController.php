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

        $parameters = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $widget = $this->itemManager->getOne(['id' => $id]);
            if($widget) {
                $parameters->set('widget', $widget);
            } else {
                return $this->displayError(404);
            }
        } else if(null !== $id) {
            $relation = $this->relationManager->getOne(['id' => $id]);
            if($relation) {
                $parameters->set('relation', $relation);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'create':
                return $this->createAction($request, $parameters, $id, $language);
            case 'read':
                return $this->readAction($request, $parameters, $id);
            case 'update':
                return $this->updateAction($request, $parameters, $id, $language);
            case 'delete':
                return $this->deleteAction($request, $parameters, $id, $language);
            case 'sort':
                return $this->sortAction($request, $parameters);
        }

        return $this->displayError(404);
    }

    public function createAction(Request $request, ParameterBag $parameters, $id, $language)
    {
        $relation = new Relation();
        $relation->setWidget($parameters->get('widget'));
        $relation->setIsActive(true);

        $form = $this->createForm(RelationType::class, $relation, [
            'relation' => $relation,
            'relations' => $this->relationManager->getList(['widget' => $parameters->get('widget')->getId()]),
            'items' => $this->itemManager->getList(['category' => 'page']),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_relations', ['language' => $language, 'action' => 'read', 'id' => $relation->getId()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        $parameters->set('relations', $this->relationManager->getList(['widget' => $parameters->get('relation')->getWidget()->getId(), 'parent' => $parameters->get('relation')->getId()]));

        return $this->render('AxipiBackendBundle:Relation:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id, $language)
    {
        $form = $this->createForm(RelationType::class, $parameters->get('relation'), [
            'relation' => $parameters->get('relation'),
            'relations' => $this->relationManager->getList(['widget' => $parameters->get('relation')->getWidget()->getId()]),
            'items' => $this->itemManager->getList(['category' => 'page']),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_relations', ['language' => $language, 'action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id, $language)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->remove($parameters->get('relation'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_widgets', ['language' => $language, 'action' => 'read', 'id' => $parameters->get('relation')->getWidget()->getId()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:delete.html.twig', $parameters->all());
    }
    public function sortAction(Request $request, ParameterBag $parameters)
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
