<?php

namespace PhlyContact\Form;

use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Hostname as HostnameValidator;

class ContactFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name'       => 'from',
            'required'   => true,
            'validators' => [
                [
                    'name'    => 'EmailAddress',
                    'options' => [
                        'allow'  => HostnameValidator::ALLOW_DNS,
                        'domain' => true,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'subject',
            'required'   => true,
            'filters'    => [
                [
                    'name'    => 'StripTags',
                ],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 140,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name'       => 'body',
            'required'   => true,
        ]);
    }
}
