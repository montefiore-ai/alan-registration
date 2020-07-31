<?php

namespace ContainerWHfxjxs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAbstractAPIControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\Api\AbstractAPIController' shared autowired service.
     *
     * @return \App\Controller\Api\AbstractAPIController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/Api/AbstractAPIController.php';
        include_once \dirname(__DIR__, 4).'/src/Service/ConfigHelper.php';

        $container->services['App\\Controller\\Api\\AbstractAPIController'] = $instance = new \App\Controller\Api\AbstractAPIController(($container->privates['App\\Service\\ConfigHelper'] ?? ($container->privates['App\\Service\\ConfigHelper'] = new \App\Service\ConfigHelper(\dirname(__DIR__, 4)))));

        $instance->setContainer(($container->privates['.service_locator.g9CqTPp'] ?? $container->load('get_ServiceLocator_G9CqTPpService'))->withContext('App\\Controller\\Api\\AbstractAPIController', $container));

        return $instance;
    }
}
