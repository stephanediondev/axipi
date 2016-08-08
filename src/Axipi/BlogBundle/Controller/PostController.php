<?php
namespace Axipi\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\CoreBundle\Manager\CommentManager;
use Axipi\BlogBundle\Form\Type\CommentType;
use Axipi\CoreBundle\Entity\Comment;

class PostController extends AbstractController
{
    protected $commentManager;

    public function __construct(
        CommentManager $commentManager
    ) {
        $this->commentManager = $commentManager;
    }

    public function getPage($parameters)
    {
        $parameters->set('blog', $this->get('axipi_core_manager_item')->getOne(['component_service' => 'axipi_blog_controller_blog', 'language_code' => $parameters->get('page')->getLanguage()->getCode(), 'active' => true]));

        $paginator  = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(['widgetParameterName' => 'page']);
        $pagination = $paginator->paginate(
            $this->commentManager->getList(['item' => $parameters->get('page'), 'active' => true]),
            $parameters->get('request')->query->getInt('page', 1),
            20
        );
        $parameters->set('comments', $pagination);

        $comment = new Comment();
        $comment->setItem($parameters->get('page'));
        $comment->setIsActive(true);

        $form = $this->createForm(CommentType::class, $comment, []);
        $form->handleRequest($parameters->get('request'));

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $this->commentManager->persist($form->getData());
                $this->addFlash('success', 'created');
                if(count($parameters->get('languages')) > 1) {
                    return $this->redirectToRoute('axipi_core_slug', ['slug' => $parameters->get('page')->getLanguage()->getCode().'/'.$parameters->get('page')->getSlug()]);
                } else {
                    return $this->redirectToRoute('axipi_core_slug', ['slug' => $parameters->get('page')->getSlug()]);
                }
            }
        }

        $parameters->set('form', $form->createView());

        if($parameters->get('page')->getTemplate()) {
            $template = $parameters->get('page')->getTemplate();
        } else {
            $template = $parameters->get('page')->getComponent()->getTemplate();
        }
        return $this->render($template, $parameters->all());
    }
}
