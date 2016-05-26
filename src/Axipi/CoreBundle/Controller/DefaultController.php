<?php
namespace Axipi\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\CoreBundle\Manager\CoreManager;

use Axipi\CoreBundle\Entity\Language;
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
        if(substr($slug, -1) == '/') {
            $slug = substr($slug, 0, -1);
        }
        $page = $this->coreManager->getBySlug($slug);
        if(!$page) {
            $page = $this->coreManager->getBySlug('error404');
        }

        $this->coreManager->setPage($page);

        if($this->has($page->getComponent()->getService())) {
            $response = $this->forward($page->getComponent()->getService().':getPage', ['page' => $page]);
            return $response;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
