<?php

namespace PhlyContact\Service;

use Interop\Container\ContainerInterface;
use Laminas\Captcha\Factory as CaptchaFactory;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Stdlib\ArrayUtils;
use Traversable;

class ContactCaptchaFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $spec = $config['phly_contact']['captcha'];
        $captcha = CaptchaFactory::factory($spec);
        return $captcha;
    }
}
