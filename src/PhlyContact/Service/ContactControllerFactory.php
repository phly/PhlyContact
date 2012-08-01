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
        $serviceLocator = $services->getServiceLocator();
        $form           = $serviceLocator->get('PhlyContactForm');
        $message        = $serviceLocator->get('PhlyContactMailMessage');
        $transport      = $serviceLocator->get('PhlyContactMailTransport');

        $controller = new ContactController();
        $controller->setContactForm($form);
        $controller->setMessage($message);
        $controller->setMailTransport($transport);
        
        return $controller;
    }
}
