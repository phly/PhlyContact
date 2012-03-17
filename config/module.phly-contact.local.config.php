<?php
/**
 * This is a sample "local" configuration for your application. To use it, copy 
 * it to your config/autoload/ directory of your application, and edit to suit
 * your application.
 *
 * This configuration example demonstrates using an SMTP mail transport, a
 * ReCaptcha CAPTCHA adapter, and setting the to and sender addresses for the
 * mail message.
 */
return array('di' => array(
    'instance' => array(
        'Zend\Mail\Message' => array('parameters' => array(
            'Zend\Mail\Message::addTo:emailOrAddressList'     => 'contact@your.tld',
            'Zend\Mail\Message::setSender:emailOrAddressList' => 'contact@your.tld',
        )),

        // This is how to configure using GMail as your SMTP server
        'Zend\Mail\Transport\SmtpOptions' => array('parameters' => array(
            'host'             => 'smtp.gmail.com',
            'port'             => 587,
            'connectionClass'  => 'login',
            'connectionConfig' => array(
                'ssl'      => 'tls',
                'username' => 'contact@your.tld',
                'password' => 'password',
            ),
        )),

        'Zend\Captcha\ReCaptcha' => array('parameters' => array(
            'pubkey'  => 'RECAPTCHA_PUBKEY_HERE',
            'privkey' => 'RECAPTCHA_PRIVKEY_HERE',
        )),

        // This tells the controller to use the SMTP transport
        'PhlyContact\Controller\ContactController' => array('parameters' => array(
            'transport' => 'Zend\Mail\Transport\Smtp',
        )),

        // This tells the form to use the ReCaptcha adapter
        'PhlyContact\Form\ContactForm' => array('parameters' => array(
            'captchaAdapter' => 'Zend\Captcha\ReCaptcha',
        )),

    ),
));
