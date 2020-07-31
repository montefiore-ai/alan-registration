<?php

namespace ContainerWHfxjxs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSecurity_Authentication_Listener_Anonymous_MainService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'security.authentication.listener.anonymous.main' shared service.
     *
     * @return \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Firewall/AbstractListener.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Firewall/AnonymousAuthenticationListener.php';

        return $container->privates['security.authentication.listener.anonymous.main'] = new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener(($container->privates['security.untracked_token_storage'] ?? ($container->privates['security.untracked_token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage())), $container->getParameter('container.build_hash'), ($container->privates['monolog.logger.security'] ?? $container->load('getMonolog_Logger_SecurityService')), ($container->privates['security.authentication.manager'] ?? $container->getSecurity_Authentication_ManagerService()));
    }
}
