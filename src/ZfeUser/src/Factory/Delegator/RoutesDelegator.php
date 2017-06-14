<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ZfeUser\Factory\Delegator;

use ZfeUser\Action;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Middleware\ImplicitHeadMiddleware;
use Zend\Expressive\Middleware\ImplicitOptionsMiddleware;
use Zend\Expressive\Middleware\NotFoundHandler;
use Zend\Stratigility\Middleware\ErrorHandler;

/**
 * Description of RoutesDelegator
 * specify roots here
 * @author Win10Laptop-Kausik
 */
class RoutesDelegator {

    /**
     * @param ContainerInterface $container
     * @param string $serviceName Name of the service being created.
     * @param callable $callback Creates and returns the service.
     * @return Application
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback) {
        /** @var $app Application */
        $app = $callback();

        // Setup routes:
        $app->get('/user/register', Action\UserRegisterAction::class, 'user.register');
        $app->get('/user/login', Action\UserLoginAction::class, 'user.login');

        return $app;
    }

}