<?php

namespace PhlyContact\Service;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Stdlib\ArrayUtils;
use PhlyContact\Form\ContactFilter;
use PhlyContact\Form\ContactForm;
use Traversable;

class ContactFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $name = $config['phly_contact']['form']['name'];
        $captcha = $container->get('PhlyContactCaptcha');
        $filter = new ContactFilter();
        $form = new ContactForm($name, $captcha);
        $form->setInputFilter($filter);
        return $form;
    }
}
