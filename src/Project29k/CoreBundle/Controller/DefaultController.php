<?php

namespace Project29k\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Project29k\CoreBundle\Manager\CoreManager;
use Project29k\CoreBundle\Shared\RenderShared;

use Project29k\CoreBundle\Entity\Object;

class DefaultController
{
    use RenderShared;

    protected $coreManager;

    public function __construct(
        CoreManager $coreManager
    ) {
        $this->coreManager = $coreManager;
    }

    public function indexAction(Request $request, $slug)
    {
        $object = new Object();
        $object->setTitle($slug);

        $response = $this->forwardExtented('core.content_controller:indexAction', ['object' => $object]);

        // ... further modify the response or return it directly

        return $response;

        $subRequest = $request->duplicate(
            $request->query->all(),
            null,
            ['_controller' => 'aqf_contact.contact_controller:showAction', 'object' => $object]
        );

        return $this->httpKernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST);

        return $this->renderExtended('CoreBundle:default:index.html.twig', [
            'object' => $object
        ]);

        throw new NotFoundHttpException();
    }
}
