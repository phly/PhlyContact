<?php

namespace PhlyContact;

use Zend\Form\View\HelperLoader as FormHelperLoader;
use Zend\Module\Consumer\AutoloaderProvider;

class Module implements AutoloaderProvider
{
    public function init($manager)
    {
        $events = $manager->getEvents();
        if (method_exists($events, 'getStaticConnections')) {
            $shared = $events->getStaticConnections();
        } elseif (method_exists($events, 'getSharedCollections')) {
            $shared = $events->getSharedCollections();
        } else {
            return;
        }

        $shared->attach('bootstrap', 'bootstrap', array($this, 'onBootstrap'));
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        $app     = $e->getParam('application');
        $locator = $app->getLocator();
        $this->helperLoader = $locator->get('Zend\View\HelperLoader');

        $app->events()->attach('route', array($this, 'onRouteFinish'), -100);
    }

    public function onRouteFinish($e)
    {
        $matches = $e->getRouteMatch();
        $controller = $e->getParam('controller');
        $namespace = substr($controller, 0, strpos($controller, '\\'));
        if ($namespace !== __NAMESPACE__) {
            return;
        }
        $this->helperLoader->registerPlugins(new FormHelperLoader());
    }
}
