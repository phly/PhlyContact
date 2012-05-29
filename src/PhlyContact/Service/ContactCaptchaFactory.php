<?php

namespace PhlyContact\Service;

use Traversable;
use Zend\Captcha\Factory as CaptchaFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class ContactCaptchaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $spec    = $config['phly_contact']['captcha'];
        $captcha = CaptchaFactory::factory($spec);
        return $captcha;
    }
}
