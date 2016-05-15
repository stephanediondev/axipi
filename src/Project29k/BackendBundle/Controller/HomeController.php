<?php

namespace Project29k\BackendBundle\Controller;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Project29k\BackendBundle\Form\Type\TypeType;
use Project29k\CoreBundle\DependencyInjection\RenderTrait;
use Project29k\CoreBundle\Entity\Type;

class HomeController
{
    use RenderTrait;

    protected $formFactory;

    protected $typeType;

    public function __construct(
        FormFactoryInterface $formFactory,
        TypeType $typeType
    ) {
        $this->formFactory = $formFactory;
        $this->typeType = $typeType;
    }

    public function indexAction()
    {
        $form = $this->formFactory->create('Project29k\BackendBundle\Form\Type\TypeType', new Type());

        $parameters = [];
        $parameters['form'] = $form->createView();
        $parameters['objects'] = [['index' => 1], ['index' => 2], ['index' => 3], ['index' => 4]];

        return $this->renderExtended('BackendBundle::home.html.twig', $parameters);
    }
}
