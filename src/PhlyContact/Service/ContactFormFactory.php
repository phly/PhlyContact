<?php

namespace PhlyContact\Service;

use PhlyContact\Form\ContactFilter;
use PhlyContact\Form\ContactForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        $name    = $config->phly_contact->form->name;
        $captcha = $services->get('PhlyContactCaptcha');
        $filter  = new ContactFilter();
        $form    = new ContactForm($name, $captcha);
        return $form;
    }
}
