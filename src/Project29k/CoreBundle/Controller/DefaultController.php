<?php
namespace Project29k\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project29k\CoreBundle\Controller\AbstractController;
use Project29k\CoreBundle\Manager\CoreManager;

use Project29k\CoreBundle\Entity\Object;

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
        $page = new Object();
        $page->setTitle($slug);

        $this->coreManager->setPage($page);

        $response = $this->forward('content.controller:getPage', ['page' => $page]);

        return $response;

        throw new NotFoundHttpException();
    }
}
