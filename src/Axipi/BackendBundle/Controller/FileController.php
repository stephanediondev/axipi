<?php
namespace Axipi\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;

use Axipi\CoreBundle\Manager\FileManager;
use Axipi\BackendBundle\Form\Type\DeleteType;
use Axipi\BackendBundle\Form\Type\FileType;
use Axipi\CoreBundle\Model\FileModel;

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
            return $this->displayError(403);
        }

        $parameterBag = new ParameterBag();
        $parameterBag->set('mode', $mode);
        $parameterBag->set('slug', $slug);

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
        $parameterBag->set('tree', $tree);

        if($action != 'index' && null !== $slug) {
            $file = $this->fileManager->getBySlug($slug);
            if($file) {
                $parameterBag->set('file', $file);
            } else {
                return $this->displayError(404);
            }
        }

        switch ($action) {
            case 'index':
                return $this->indexAction($request, $parameterBag, $slug);
            case 'create':
                return $this->createAction($request, $parameterBag, $slug);
            case 'read':
                return $this->readAction($request, $parameterBag, $slug);
            case 'update':
                return $this->updateAction($request, $parameterBag, $slug);
            case 'delete':
                return $this->deleteAction($request, $parameterBag, $slug);
            case 'upload':
                return $this->uploadAction($request, $parameterBag, $slug);
        }

        return $this->displayError(404);
    }

    public function indexAction(Request $request, ParameterBag $parameterBag, $slug)
    {
        $parameterBag->set('objects', $this->fileManager->getRows($slug));

        return $this->render('AxipiBackendBundle:File:index.html.twig', $parameterBag->all());
    }

    public function createAction(Request $request, ParameterBag $parameterBag, $slug)
    {
        $file = new FileModel();

        $form = $this->createForm(FileType::class, $file, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->fileManager->persist($form->getData());
                $this->addFlash('success', 'created');
                return $this->redirectToRoute('axipi_backend_file', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:File:create.html.twig', $parameterBag->all());
    }

    public function readAction(Request $request, ParameterBag $parameterBag, $slug)
    {
        return $this->render('AxipiBackendBundle:File:read.html.twig', $parameterBag->all());
    }

    public function updateAction(Request $request, ParameterBag $parameterBag, $slug)
    {
        $form = $this->createForm(FileType::class, $parameterBag->get('file'), []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->fileManager->persist($form->getData());
                $this->addFlash('success', 'updated');
                return $this->redirectToRoute('axipi_backend_file', ['action' => 'read', 'id' => $slug]);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:File:update.html.twig', $parameterBag->all());
    }

    public function deleteAction(Request $request, ParameterBag $parameterBag, $slug)
    {
        $form = $this->createForm(DeleteType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->fileManager->remove($slug);
                $this->addFlash('success', 'deleted');
                return $this->redirectToRoute('axipi_backend_file', []);
            }
        }

        $parameterBag->set('form', $form->createView());

        return $this->render('AxipiBackendBundle:File:delete.html.twig', $parameterBag->all());
    }

    public function uploadAction(Request $request, $parameterBag, $slug)
    {
        $data = [];

        foreach($request->files->get('files', []) as $key => $uploadedFile) {
            $file = new FileModel();
            $file->setFile($uploadedFile);
            $file->setDir($slug);

            $filename = $this->fileManager->persist($file);

            $data[] = [
                'id' => $filename,
                'title' => $filename,
                'icon' => 'file-o',
                'href' => $this->generateUrl('axipi_backend_file', ['action' => 'read', 'slug' => $slug.'/'.$filename]),
            ];
        }

        return new JsonResponse($data);
    }
}
