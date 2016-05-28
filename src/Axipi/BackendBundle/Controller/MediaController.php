<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\BackendBundle\Manager\MediaManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\MediaType;
use Axipi\CoreBundle\Entity\Media;

class MediaController extends AbstractController
{
    protected $mediaManager;

    public function __construct(
        MediaManager $mediaManager
    ) {
        $this->mediaManager = $mediaManager;
    }

    public function dispatchAction(Request $request, $action, $slug)
    {
        if(!$this->isGranted('ROLE_MEDIAS')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();
        $parameters->set('slug', $slug);

        $tree = [];
        $tree[] = ['slug' => '', 'name' => 'medias', 'icon' => 'folder'];
        if($slug != '') {
            $parts = explode('/', $this->mediaManager->cleanSlash($slug));
            $total_parts = count($parts);
            $start = '';
            $u = 0;
            foreach($parts as $part) {
                $start = $start.'/'.$part;
                $tree[] = $this->mediaManager->getBySlug($start);//['slug' => $this->mediaManager->cleanSlash($start), 'name' => $part];
                $u++;
            }
        }
        $parameters->set('tree', $tree);

        if($action != 'index' && null !== $slug) {
            $media = $this->mediaManager->getBySlug($slug);
            if($media) {
                $parameters->set('media', $media);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_media', []);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameters, $slug);
            case 'create':
                return $this->createAction($request, $parameters, $slug);
            case 'read':
                return $this->readAction($request, $parameters, $slug);
            case 'update':
                return $this->updateAction($request, $parameters, $slug);
            case 'delete':
                return $this->deleteAction($request, $parameters, $slug);
        }

        $this->addFlash('danger', 'not found');
        return $this->redirectToRoute('axipi_backend_media', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $slug)
    {
        $parameters->set('objects', $this->mediaManager->getRows($slug));

        return $this->render('AxipiBackendBundle:Media:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters, $slug)
    {
        $media = new Media();
        $media->setIsActive(true);

        $form = $this->createForm(MediaType::class, $media, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->mediaManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_media', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Media:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $slug)
    {
        return $this->render('AxipiBackendBundle:Media:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $slug)
    {
        $form = $this->createForm(MediaType::class, $parameters->get('media'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->mediaManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_media', ['action' => 'read', 'id' => $slug]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Media:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $slug)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->mediaManager->remove($parameters->get('media'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_media', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:Media:delete.html.twig', $parameters->all());
    }
}
