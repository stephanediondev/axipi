<?php
namespace Axipi\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\CoreBundle\Manager\CoreManager;

use Axipi\CoreBundle\Entity\Program;
use Axipi\CoreBundle\Entity\Page;

class DefaultController extends AbstractController
{

    protected $coreManager;

    public function __construct(
        CoreManager $coreManager
    ) {
        $this->coreManager = $coreManager;
    }

    public function indexAction(Request $request, $slug)
    {
        $program = new Program();
        //$program->setLanguage(1);

        $this->coreManager->setProgram($program);

        $page = new Page();
        $page->setTitle($slug);

        $this->coreManager->setPage($page);

        $service = 'content.controller';
        if($this->has($service)) {
            $response = $this->forward($service.':getPage', ['page' => $page, 'program' => $program]);
            return $response;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
