<?php

namespace Project29k\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Project29k\CoreBundle\Manager\CoreManager;
use Project29k\CoreBundle\DependencyInjection\RenderTrait;

use Project29k\CoreBundle\Entity\Object;

class DefaultController
{
    use RenderTrait;

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

        $response = $this->forwardExtented('core.content_controller:get', ['page' => $page]);

        return $response;

        throw new NotFoundHttpException();
    }
}
