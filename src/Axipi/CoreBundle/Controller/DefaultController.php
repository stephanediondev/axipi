<?php
namespace Axipi\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\CoreBundle\Manager\DefaultManager;
use Axipi\CoreBundle\Manager\ItemManager;

class DefaultController extends AbstractController
{

    protected $defaultManager;

    protected $itemManager;

    public function __construct(
        DefaultManager $defaultManager,
        ItemManager $itemManager
    ) {
        $this->defaultManager = $defaultManager;
        $this->itemManager = $itemManager;
    }

    public function indexAction(Request $request, $slug, $language = null)
    {
        if(substr($slug, -1) == '/') {
            $slug = substr($slug, 0, -1);
        }
        $page = $this->itemManager->getOne(['slug' => $slug, 'active' => true]);
        if(!$page) {
            $page = $this->itemManager->getOne(['component_service' => 'axipi_content_controller_error404', 'category' => 'page', 'active' => true]);
        }

        $this->defaultManager->setPage($page);

        if($this->has($page->getComponent()->getService())) {
            $response = $this->forward($page->getComponent()->getService().':getPage', ['request' => $request, 'page' => $page]);
            return $response;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
