<?php

namespace PhlyContact\Service;

use Zend\Captcha\Factory as CaptchaFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactCaptchaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        $spec    = $config->phly_contact->captcha;
        $captcha = CaptchaFactory::factory($spec);
        return $captcha;
    }
}
