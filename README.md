PhlyContact
====

This is a simple Laminas module implementing a contact form.

Requirements
----

* PHP >= 5.3.3
* Zend Framework 2, beta4 or later, specifically:
    * Laminas\Captcha (used for CAPTCHA functionality on the forms)
    * Laminas\InputFilter (used for validating the contact form); in turn, uses:
        * Laminas\Filter
        * Laminas\Uri
        * Laminas\Validator
    * Laminas\Form (the contact form itself; currently supports beta4 or later)
    * Laminas\Mail (for sending the contact emails)
    * Laminas\ModuleManager (implements a Laminas module)
    * Laminas\Mvc (provides a controller)
    * Laminas\ServiceManager (provides service factories)
    * Laminas\View (provides view scripts for the PhpRenderer, and utilizes
      ViewModels in the controller)

Installation
----

Install the module by cloning it into ./vendor/ and enabling it in your
application.config.php file.

You will need to configure the following:

* The CAPTCHA to use, and any options related to it.
* The mail transport to use, and any options related to it.
* If you wish to alter the root path in the site to which the controller will
  resolve, you will need to override the routing configuration.
* If you wish to modify the output, you will need to create alternate templates,
  and configure overrides in your configuration to ensure your versions are
  used.

Sample configuration for use in your application autoload configuration is
provided, demonstrating usage of the ReCaptcha CAPTCHA adapter, the SMTP mail
transport, and setting mail message defaults. This is in
`config\module.phly-contact.local.php`.

License
----

Copyright (c) 2012, Matthew Weier O'Phinney
All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice, this
  list of conditions and the following disclaimer in the documentation and/or
  other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
