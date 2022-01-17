<?php

namespace PhlyContact\Form;

use Laminas\Captcha\AdapterInterface as CaptchaAdapter;
use Laminas\Form\Element;
use Laminas\Form\Form;

class ContactForm extends Form
{
    protected $captchaAdapter;
    protected $csrfToken;

    public function __construct($name = null, CaptchaAdapter $captchaAdapter = null)
    {
        parent::__construct($name);

        if (null !== $captchaAdapter) {
            $this->captchaAdapter = $captchaAdapter;
        }

        $this->init();
    }

    public function init()
    {
        $name = $this->getName();
        if (null === $name) {
            $this->setName('contact');
        }

        $this->add([
            'name' => 'from',
            'type' => 'Laminas\Form\Element\Text',
            'options' => [
                'label' => 'From:',
            ],
        ]);

        $this->add([
            'name'  => 'subject',
            'type' => 'Laminas\Form\Element\Text',
            'options' => [
                'label' => 'Subject:',
            ],
        ]);


        $this->add([
            'name'  => 'body',
            'type'  => 'Laminas\Form\Element\Textarea',
            'options' => [
                'label' => 'Your message:',
            ],
        ]);

        $captcha = new Element\Captcha('captcha');
        $captcha->setCaptcha($this->captchaAdapter);
        $captcha->setOptions(['label' => 'Please verify you are human.']);
        $this->add($captcha);

        $this->add(new Element\Csrf('csrf'));

        $this->add([
            'name' => 'Send',
            'type'  => 'Laminas\Form\Element\Submit',
            'attributes' => [
                'value' => 'Send',
            ],
        ]);
    }
}
