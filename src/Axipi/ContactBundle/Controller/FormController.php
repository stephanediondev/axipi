<?php
namespace Axipi\ContactBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Controller\AbstractController;
use Axipi\ContactBundle\Form\Type\MessageType;

class FormController extends AbstractController
{
    public function getPage($parameters)
    {
        $form = $this->createForm(MessageType::class, null, []);
        $form->handleRequest($parameters->get('request'));

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $data = $form->getData();

                $message = \Swift_Message::newInstance();
                $message->setSubject($parameters->get('page')->getTitle());
                $message->setFrom(array($parameters->get('page')->getAttribute('recipient_email') => $parameters->get('page')->getAttribute('recipient_name')));
                $message->setTo(array($parameters->get('page')->getAttribute('recipient_email') => $parameters->get('page')->getAttribute('recipient_name')));
                $message->setReplyTo(array($data['email'] => $data['author']));
                $message->setBody($data['message']);

                $this->get('mailer')->send($message);

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
        $response = $this->render($template, $parameters->all());
        return $response;
    }
}
