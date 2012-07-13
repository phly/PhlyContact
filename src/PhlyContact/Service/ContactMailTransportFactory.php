<?php

namespace PhlyContact\Service;

use Traversable;
use Zend\Mail\Transport;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class ContactMailTransportFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $config  = $config['phly_contact']['mail_transport'];
        $class   = $config['class'];
        $options = $config['options'];

        switch ($class) {
            case 'Zend\Mail\Transport\Sendmail':
            case 'Sendmail':
            case 'sendmail';
                $transport = new Transport\Sendmail();
                break;
            case 'Zend\Mail\Transport\Smtp';
            case 'Smtp';
            case 'smtp';
                $options = new Transport\SmtpOptions($options);
                $transport = new Transport\Smtp($options);
                break;
            case 'Zend\Mail\Transport\File';
            case 'File';
            case 'file';
                $options = new Transport\FileOptions($options);
                $transport = new Transport\File($options);
                break;
            default:
                throw new \DomainException(sprintf(
                    'Unknown mail transport type provided ("%s")',
                    $class
                ));
        }

        return $transport;
    }
}
