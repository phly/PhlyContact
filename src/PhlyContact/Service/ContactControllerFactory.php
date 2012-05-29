<?php

namespace PhlyContact\Service;

use PhlyContact\Controller\ContactController;
use Zend\Mail\Message;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config    = $services->get('config');
        $form      = $services->get('PhlyContactForm');
        $message   = $services->get('PhlyContactMailMessage');
        $transport = $services->get('PhlyContactMailTransport');
        $events    = $services->get('EventManager');

        $controller = new ContactController();
        $controller->setServiceManager($services);
        $controller->setEventManager($events);
        $controller->setMessage($message);
        $controller->setMailTransport($transport);
        $controller->setContactForm($form);
        
        return $controller;
    }
}
