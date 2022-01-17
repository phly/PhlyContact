<?php

namespace PhlyContact\Controller;

use PhlyContact\Form\ContactForm;
use Laminas\Mail\Transport;
use Laminas\Mail\Message as Message;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    protected $form;
    protected $message;
    protected $transport;

    public function setMessage(Message $message)
    {
        $this->message = $message;
    }

    public function setMailTransport(Transport\TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    public function indexAction()
    {
        return [
            'form' => $this->form,
        ];
    }

    public function processAction()
    {
        if (! $this->request->isPost()) {
            return $this->redirect()->toRoute('contact');
        }

        $post = $this->request->getPost();
        $form = $this->form;
        $form->setData($post);
        if (! $form->isValid()) {
            $model = new ViewModel([
                'error' => true,
                'form'  => $form,
            ]);
            $model->setTemplate('phly-contact/contact/index');
            return $model;
        }

        // send email...
        $this->sendEmail($form->getData());

        return $this->redirect()->toRoute('contact/thank-you');
    }

    public function thankYouAction()
    {
        $headers = $this->request->getHeaders();
        if (
            ! $headers->has('Referer')
            || ! preg_match('#/contact$#', $headers->get('Referer')->getFieldValue())
        ) {
            return $this->redirect()->toRoute('contact');
        }

        return [];
    }

    public function setContactForm(ContactForm $form)
    {
        $this->form = $form;
    }

    protected function sendEmail(array $data)
    {
        $from    = $data['from'];
        $subject = '[Contact Form] ' . $data['subject'];
        $body    = $data['body'];

        $this->message->addFrom($from)
                      ->addReplyTo($from)
                      ->setSubject($subject)
                      ->setBody($body);
        $this->transport->send($this->message);
    }
}
