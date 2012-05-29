<?php

namespace PhlyContact\Service;

use Traversable;
use Zend\Mail\Message;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class ContactMailMessageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $config  = $config['phly_contact']['message'];

        $message = new Message();

        if (isset($config['to'])) {
            $message->addTo($config['to']);
        }

        if (isset($config['from'])) {
            $message->addFrom($config['from']);
        }

        if (isset($config['sender']) && isset($config['sender']['address'])) {
            $address = $config['sender']['address'];
            $name    = isset($config['sender']['name']) ? $config['sender']['name'] : null;
            $message->setSender($address, $name);
        }

        return $message;
    }
}
