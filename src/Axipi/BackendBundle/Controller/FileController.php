<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\FileManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\FileType;
use Axipi\CoreBundle\Entity\File;

class FileController extends AbstractController
{
    protected $fileManager;

    public function __construct(
        FileManager $fileManager
    ) {
        $this->fileManager = $fileManager;
    }

    public function dispatchAction(Request $request, $mode, $action, $slug)
    {
        if(!$this->isGranted('ROLE_FILES')) {
            return $this->redirectToRoute('axipi_backend_home', []);
        }

        $parameters = new ParameterBag();
        $parameters->set('mode', $mode);
        $parameters->set('slug', $slug);

        $tree = [];
        $tree[] = ['slug' => '', 'name' => 'files', 'icon' => 'folder'];
        if($slug != '') {
            $parts = explode('/', $this->fileManager->cleanSlash($slug));
            $total_parts = count($parts);
            $start = '';
            $u = 0;
            foreach($parts as $part) {
                $start = $start.'/'.$part;
                $tree[] = $this->fileManager->getBySlug($start);//['slug' => $this->fileManager->cleanSlash($start), 'name' => $part];
                $u++;
            }
        }
        $parameters->set('tree', $tree);

        if($action != 'index' && null !== $slug) {
            $file = $this->fileManager->getBySlug($slug);
            if($file) {
                $parameters->set('file', $file);
            } else {
                $this->addFlash('danger', 'not found');
                return $this->redirectToRoute('axipi_backend_files', []);
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
        return $this->redirectToRoute('axipi_backend_files', []);
    }

    public function indexAction(Request $request, ParameterBag $parameters, $slug)
    {
        $parameters->set('objects', $this->fileManager->getRows($slug));

        return $this->render('AxipiBackendBundle:MaterialDesignLite/File:index.html.twig', $parameters->all());
    }

    public function createAction(Request $request, ParameterBag $parameters, $slug)
    {
        $file = new File();
        $file->setIsActive(true);

        $form = $this->createForm(FileType::class, $file, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->fileManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_files', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:MaterialDesignLite/File:create.html.twig', $parameters->all());
    }

    public function readAction(Request $request, ParameterBag $parameters, $slug)
    {
        return $this->render('AxipiBackendBundle:MaterialDesignLite/File:read.html.twig', $parameters->all());
    }

    public function updateAction(Request $request, ParameterBag $parameters, $slug)
    {
        $form = $this->createForm(FileType::class, $parameters->get('file'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->fileManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_files', ['action' => 'read', 'id' => $slug]);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:MaterialDesignLite/File:update.html.twig', $parameters->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameters, $slug)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->fileManager->remove($parameters->get('file'));
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_files', []);
            }
        }

        $parameters->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:MaterialDesignLite/File:delete.html.twig', $parameters->all());
    }
}
