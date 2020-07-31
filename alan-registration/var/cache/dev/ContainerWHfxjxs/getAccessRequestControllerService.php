<?php

namespace ContainerWHfxjxs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAccessRequestControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\Api\AccessRequestController' shared autowired service.
     *
     * @return \App\Controller\Api\AccessRequestController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/Api/AbstractAPIController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/Api/AccessRequestController.php';
        include_once \dirname(__DIR__, 4).'/src/Service/ConfigHelper.php';

        $container->services['App\\Controller\\Api\\AccessRequestController'] = $instance = new \App\Controller\Api\AccessRequestController(($container->privates['App\\Service\\ConfigHelper'] ?? ($container->privates['App\\Service\\ConfigHelper'] = new \App\Service\ConfigHelper(\dirname(__DIR__, 4)))), ($container->privates['App\\Repository\\AccessRequestRepository'] ?? $container->load('getAccessRequestRepositoryService')));

        $instance->setContainer(($container->privates['.service_locator.g9CqTPp'] ?? $container->load('get_ServiceLocator_G9CqTPpService'))->withContext('App\\Controller\\Api\\AccessRequestController', $container));

        return $instance;
    }
}
