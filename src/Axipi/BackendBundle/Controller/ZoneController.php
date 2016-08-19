<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\ZoneManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\ZoneType;
use Axipi\CoreBundle\Entity\Zone;

class ZoneController extends AbstractController
{
    protected $zoneManager;

    public function __construct(
        ZoneManager $zoneManager
    ) {
        $this->zoneManager = $zoneManager;
    }

    public function dispatchAction(Request $request, $action, $id)
    {
        if(!$this->isGranted('ROLE_ZONES')) {
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();

        if(null !== $id) {
            $zone = $this->zoneManager->getOne(['id' => $id]);
            if($zone) {
                $parameterBag->set('zone', $zone);
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
                return $this->deleteAction($request, $parameterBag);
            case 'sort':
                return $this->sortAction($request, $parameterBag);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag)
    {
        $parameterBag->set('objects', $this->zoneManager->getList());

        return $this->render('AxipiBackendBundle:Zone:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag)
    {
        $zone = new Zone();
        $zone->setIsActive(true);

        $form = $this->createForm(ZoneType::class, $zone, [
            'zone' => $zone,
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->zoneManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_zone', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Zone:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag)
    {
        return $this->render('AxipiBackendBundle:Zone:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(ZoneType::class, $parameterBag->get('zone'), [
            'zone' => $parameterBag->get('zone'),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->zoneManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_zone', ['action' => 'read', 'id' => $parameterBag->get('widget')->getId()]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Zone:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->zoneManager->remove($parameterBag->get('zone'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_zone', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Zone:delete.html.twig', $parameterBag->all());
    }

    public function sortAction(Request $request, ParameterBag $parameterBag)
    {
        $data = json_decode($request->request->get('result'));
        foreach($data as $id => $ordering) {
            $zone = $this->zoneManager->getOne(['id' => intval($id)]);
            if($zone) {
                $zone->setOrdering(intval($ordering));
                $this->zoneManager->persist($zone);
            }
        }

        return new JsonResponse($data);
    }
}
