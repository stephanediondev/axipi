<?php
namespace Project29k\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $service = 'content.controller';
        if($this->has($service)) {
            $response = $this->forward($service.':getPage', ['page' => $page]);
            return $response;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
