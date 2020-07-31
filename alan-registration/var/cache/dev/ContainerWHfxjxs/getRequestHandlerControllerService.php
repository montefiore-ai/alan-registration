<?php

namespace ContainerWHfxjxs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getRequestHandlerControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\RequestHandlerController' shared autowired service.
     *
     * @return \App\Controller\RequestHandlerController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/RequestHandlerController.php';

        $container->services['App\\Controller\\RequestHandlerController'] = $instance = new \App\Controller\RequestHandlerController(($container->privates['App\\Repository\\AccessRequestRepository'] ?? $container->load('getAccessRequestRepositoryService')), ($container->services['doctrine.orm.default_entity_manager'] ?? $container->getDoctrine_Orm_DefaultEntityManagerService()), ($container->privates['App\\Service\\Mail\\MailHelper'] ?? $container->load('getMailHelperService')));

        $instance->setContainer(($container->privates['.service_locator.g9CqTPp'] ?? $container->load('get_ServiceLocator_G9CqTPpService'))->withContext('App\\Controller\\RequestHandlerController', $container));

        return $instance;
    }
}
