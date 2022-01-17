<?php

namespace PhlyContact\Service;

use Interop\Container\ContainerInterface;
use Laminas\Mail\Transport;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Stdlib\ArrayUtils;
use Traversable;

class ContactMailTransportFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        {
            $config = $container->get('config');
            if ($config instanceof Traversable) {
                $config = ArrayUtils::iteratorToArray($config);
            }
            $config = $config['phly_contact']['mail_transport'];
            $class = $config['class'];
            $options = $config['options'];

            switch ($class) {
                case 'Laminas\Mail\Transport\Sendmail':
                case 'Sendmail':
                case 'sendmail';
                    $transport = new Transport\Sendmail();
                    break;
                case 'Laminas\Mail\Transport\Smtp';
                case 'Smtp';
                case 'smtp';
                    $options = new Transport\SmtpOptions($options);
                    $transport = new Transport\Smtp($options);
                    break;
                case 'Laminas\Mail\Transport\File';
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
}

