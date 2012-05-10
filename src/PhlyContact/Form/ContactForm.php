<?php
namespace PhlyContact\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;

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
        
        $this->add(array(
            'name' => 'from',
            'attributes' => array(
                'label' => 'From:',
                'type'  => 'text',
            ),
        ));

        $this->add(array(
            'name'  => 'subject',
            'attributes' => array(
                'label' => 'Subject:',
                'type'  => 'text',
            ),
        ));


        $this->add(array(
            'name'  => 'body',
            'attributes' => array(
                'label' => 'Your message:',
                'type'  => 'textarea',
            ),
        ));

        $captcha = new Element\Captcha('captcha');
        $captcha->setCaptcha($this->captchaAdapter);
        $captcha->setAttribute('label', 'Please verify you are human.');
        $this->add($captcha);

        $this->add(new Element\Csrf('csrf'));

        $this->add(array(
            'name' => 'Send',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Send',
            ),
        ));
    }
}
