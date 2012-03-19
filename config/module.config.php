<?php
$config = array('di' => array(
    'definition' => array('class' => array(
        'PhlyContact\Controller\ContactController' => array(
            'setContactForm' => array(
                'required' => true,
                'form' => array(
                    'required' => true,
                    'type'     => 'PhlyContact\Form\ContactForm',
                ),
            ),
            'setMessage' => array(
                'required' => true,
                'message' => array(
                    'required' => true,
                    'type'     => 'Zend\Mail\Message',
                ),
            ),
            'setMailTransport' => array(
                'required' => true,
                'transport' => array(
                    'required' => true,
                    'type'     => 'Zend\Mail\Transport',
                ),
            ),
        ),
        'PhlyContact\Form\ContactForm' => array(
            '__construct' => array(
                'required' => true,
                'captchaAdapter' => array(
                    'required' => true,
                    'type'     => 'Zend\Captcha\Adapter',
                ),
            ),
        ),
        // The following is provided in order to simplify configuration of a
        // ReCaptcha adapter.
        'Zend\Captcha\ReCaptcha' => array(
            'setPrivkey' => array(
                'privkey' => array(
                    'required' => true,
                    'type'     => false,
                ),
            ),
            'setPubkey' => array(
                'pubkey' => array(
                    'required' => true,
                    'type'     => false,
                ),
            ),
            'setOption' => array(
                'key' => array(
                    'required' => false,
                    'type'     => false,
                ),
                'value' => array(
                    'required' => false,
                    'type'     => false,
                ),
            ),
        ),
        // The following is provided in order to allow injection of a To: 
        // address, From: address, and sender.
        'Zend\Mail\Message' => array(
            'addTo' => array(
                'emailOrAddressList' => array(
                    'type' => false,
                    'required' => true,
                ),
                'name' => array(
                    'type' => false,
                    'required' => false,
                ),
            ),
            'addFrom' => array(
                'emailOrAddressList' => array(
                    'type' => false,
                    'required' => true,
                ),
                'name' => array(
                    'type' => false,
                    'required' => false,
                ),
            ),
            'setSender' => array(
                'emailOrAddressList' => array(
                    'type' => false,
                    'required' => true,
                ),
                'name' => array(
                    'type' => false,
                    'required' => false,
                ),
            ),
        ),
    )),
    'instance' => array(
        'preferences' => array(
            'Zend\Mail\Transport'  => 'Zend\Mail\Transport\Sendmail',
            'Zend\Captcha\Adapter' => 'Zend\Captcha\Dumb',
        ),

        // Defaults for mail message... these will clue the end-user in that
        // they need to override in app configuration.
        'Zend\Mail\Message' => array('parameters' => array(
            'Zend\Mail\Message::addTo:emailOrAddressList' => 'EMAIL HERE',
            'Zend\Mail\Message::addTo:name'  => "NAME HERE",
            'Zend\Mail\Message::setSender:emailOrAddressList' => 'EMAIL HERE',
            'Zend\Mail\Message::setSender:name'  => "NAME HERE",
        )),

        // Template map for the two templates we provide for the PhpRenderer
        'Zend\View\Resolver\TemplateMapResolver' => array('parameters' => array(
            'map' => array(
                'contact/index'     => __DIR__ . '/../view/phly-contact/contact/index.phtml',
                'contact/thank-you' => __DIR__ . '/../view/phly-contact/contact/thank-you.phtml',
            ),
        )),

        // Paths for the TemplatePathStack if used
        'Zend\View\Resolver\TemplatePathStack' => array('parameters' => array(
            'paths' => array(
                'contact' => __DIR__ . '/../view/phly-contact',
            ),
        )),

        // Injection points for the controller
        // Use the Sendmail mail transport by default
        'PhlyContact\Controller\ContactController' => array('parameters' => array(
            'message'   => 'Zend\Mail\Message',
            'form'      => 'PhlyContact\Form\ContactForm',
        )),

        // If using a ReCaptcha, define these
        'Zend\Captcha\ReCaptcha' => array('parameters' => array(
            'pubkey'  => 'RECAPTCHA_PUBKEY_HERE',
            'privkey' => 'RECAPTCHA_PRIVKEY_HERE',
        )),
        
        // Routes
        'Zend\Mvc\Router\RouteStack' => array('parameters' => array(                                          
            'routes' => array(
                'contact' => array(
                    'type' => 'Literal',
                    'options' => array(
                        'route' => '/contact',
                        'defaults' => array(
                            'controller' => 'PhlyContact\Controller\ContactController',
                            'action'     => 'index',
                        ),
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'process' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/process',
                                'defaults' => array(
                                    'action' => 'process',
                                ),
                            ),
                        ),
                        'thank-you' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/thank-you',
                                'defaults' => array(
                                    'action' => 'thank-you',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        )),
    ),
));
return $config;
