<?php

namespace Project29k\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

use Project29k\CoreBundle\DependencyInjection\RenderTrait;
use Project29k\CoreBundle\Entity\Type;

class HomeController
{
    use RenderTrait;

    protected $formFactory;

    public function __construct(
        FormFactoryInterface $formFactory
    ) {
        $this->formFactory = $formFactory;
    }

    public function indexAction(Request $request)
    {
        $form = $this->formFactory->create('Project29k\BackendBundle\Form\Type\TypeType', new Type(), ['new_option' => 'OO']);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                echo 'oo';
            }
        }

        $parameters = [];
        $parameters['form'] = $form->createView();
        $parameters['objects'] = [['index' => 1], ['index' => 2], ['index' => 3], ['index' => 4]];

        return $this->renderExtended('BackendBundle::home.html.twig', $parameters);
    }
}
