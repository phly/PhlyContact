<?php

namespace PhlyContact\Service;

use Interop\Container\ContainerInterface;
use Laminas\Mail\Message;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Stdlib\ArrayUtils;
use Traversable;

class ContactMailMessageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $config = $config['phly_contact']['message'];

        $message = new Message();

        if (isset($config['to'])) {
            $message->addTo($config['to']);
        }

        if (isset($config['from'])) {
            $message->addFrom($config['from']);
        }

        if (isset($config['sender']) && isset($config['sender']['address'])) {
            $address = $config['sender']['address'];
            $name = isset($config['sender']['name']) ? $config['sender']['name'] : null;
            $message->setSender($address, $name);
        }

        return $message;
    }

}
