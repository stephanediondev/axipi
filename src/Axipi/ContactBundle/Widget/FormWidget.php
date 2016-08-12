<?php
namespace Axipi\ContactBundle\Widget;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

use Axipi\CoreBundle\Widget\AbstractWidget;
use Axipi\ContactBundle\Form\Type\MessageType;

class FormWidget extends AbstractWidget
{
    public function getWidget(Request $request, ParameterBag $parameters)
    {
        $form = $this->createForm(MessageType::class, null, []);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            if($form->isValid()) {
                $data = $form->getData();

                $message = \Swift_Message::newInstance();
                $message->setSubject($parameters->get('widget')->getTitle());
                $message->setFrom(array($parameters->get('widget')->getAttribute('recipient_email') => $parameters->get('widget')->getAttribute('recipient_name')));
                $message->setTo(array($parameters->get('widget')->getAttribute('recipient_email') => $parameters->get('widget')->getAttribute('recipient_name')));
                $message->setReplyTo(array($data['email'] => $data['author']));
                $message->setBody(strip_tags($data['message']));

                $this->get('mailer')->send($message);

                $this->addFlash('success', 'created');
            }
        }

        $parameters->set('form', $form->createView());

        if($parameters->get('widget')->getTemplate()) {
            $template = $parameters->get('widget')->getTemplate();
        } else {
            $template = $parameters->get('widget')->getComponent()->getTemplate();
        }
        return $this->renderView($template, $parameters->all());
    }
}
