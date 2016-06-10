<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();

        if($action == 'create' && null !== $id) {
            $widget = $this->itemManager->getOne(['id' => $id]);
            if($widget) {
                $parameters->set('widget', $widget);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widgets', []);
            }
        } else if(null !== $id) {
            $relation = $this->relationManager->getOne(['id' => $id]);
            if($relation) {
                $parameters->set('relation', $relation);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_widgets', []);
            }
        }

        switch ($action) {
            case 'create':
                return $this->createAction($request, $parameters, $id);
            case 'read':
                return $this->readAction($request, $parameters, $id);
            case 'update':
                return $this->updateAction($request, $parameters, $id);
            case 'delete':
                return $this->deleteAction($request, $parameters, $id);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_widgets', []);
    }

    public function createAction(Request $request, ParameterBag $parameters, $id)
    {
        $relation = new Relation();
        $relation->setWidget($parameters->get('widget'));
        $relation->setIsActive(true);

        $form = $this->createForm(RelationType::class, $relation, [
            'relation' => $relation,
            'items' => $this->itemManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_relations', ['action' => 'read', 'id' => $relation->getId()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $id)
    {
        return $this->render('AxipiBackendBundle:Relation:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(RelationType::class, $parameters->get('relation'), [
            'relation' => $parameters->get('relation'),
            'items' => $this->itemManager->getList(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_relations', ['action' => 'read', 'id' => $id]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $id)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->relationManager->remove($parameters->get('relation'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_widgets', ['action' => 'read', 'id' => $parameters->get('relation')->getWidget()->getId()]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Relation:delete.html.twig', $parameters->all());
    }
}
