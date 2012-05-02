<?php
namespace PhlyContact\Form;

use Zend\Captcha\Adapter as CaptchaAdapter;
use Zend\Form\Factory as FormFactory;
use Zend\Form\Form;

class ContactForm extends Form
{
    protected $captchaAdapter;
    protected $csrfToken;

    public function __construct($name = null, CaptchaAdapter $captchaAdapter = null, $csrfToken = null)
    {
        parent::__construct($name);

        if (null !== $captchaAdapter) {
            $this->captchaAdapter = $captchaAdapter;
        }
        $this->csrfToken = $csrfToken;

        $this->init();
    }

    public function init()
    {
        $factory = new FormFactory();
        $name = $this->getName();
        if (null === $name) {
            $this->setName('contact');
        }
        
        $this->add($factory->createElement(array(
            'name' => 'from',
            'attributes' => array(
                'label' => 'From:',
                'type'  => 'text',
            ),
        )));

        $this->add($factory->createElement(array(
            'name'  => 'subject',
            'attributes' => array(
                'label' => 'Subject:',
                'type'  => 'text',
            ),
        )));


        $this->add($factory->createElement(array(
            'name'  => 'body',
            'attributes' => array(
                'label' => 'Your message:',
                'type'  => 'textarea',
            ),
        )));

        $this->add($factory->createElement(array(
            'name' => 'captcha',
            'attributes' => array(
                'label'   => 'Please verify you are human.',
                'captcha' => $this->captchaAdapter,
            ),
        )));

        /*
         * Omitting until we have a CSRF validator
        $this->add($factory->createElement(array(
            'name' => 'csrf',
            'attributes' => array(
                'type'  => 'hidden',
                'value' => $this->csrfToken,
            ),
        )));
         */

        $this->add($factory->createElement(array(
            'name' => 'Send',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Send',
            ),
        )));
    }
}
