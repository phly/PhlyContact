<?php
namespace PhlyContact\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Validator\Hostname as HostnameValidator;

class ContactFilter extends InputFilter
{
    public function __construct($captchaAdapter = null)
    {
        $factory = new InputFactory();

        if ($captchaAdapter instanceof CaptchaAdapter) {
            $captcha = $factory->createInput(array(
                'name' => 'captcha',
                'required' => true,
                'validators' => array($captchaAdapter),
            ));
            $this->add($captcha);
        };

        $this->add($factory->createInput(array(
            'name'       => 'from',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'EmailAddress',
                    'options' => array(
                        'allow'  => HostnameValidator::ALLOW_DNS,
                        'domain' => true,
                    ),
                ),
            ),
        )));

        $this->add($factory->createInput(array(
            'name'       => 'subject',
            'required'   => true,
            'filters'    => array(
                array(
                    'name'    => 'StripTags',
                ),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 140,
                    ),
                ),
            ),
        )));

        $this->add($factory->createInput(array(
            'name'       => 'body',
            'required'   => true,
        )));

        /*
         * Omitting until we have a CSRF validator
        $this->add($factory->createInput(array(
            'name'       => 'csrf',
            'required'   => true,
        )));
         */
    }
}
