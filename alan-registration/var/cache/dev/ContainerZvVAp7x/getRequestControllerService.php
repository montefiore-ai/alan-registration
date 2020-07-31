<?php

namespace ContainerZvVAp7x;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getRequestControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\RequestController' shared autowired service.
     *
     * @return \App\Controller\RequestController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/RequestController.php';

        $container->services['App\\Controller\\RequestController'] = $instance = new \App\Controller\RequestController();

        $instance->setContainer(($container->privates['.service_locator.g9CqTPp'] ?? $container->load('get_ServiceLocator_G9CqTPpService'))->withContext('App\\Controller\\RequestController', $container));

        return $instance;
    }
}
