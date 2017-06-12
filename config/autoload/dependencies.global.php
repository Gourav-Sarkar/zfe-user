<?php

use Zend\Expressive\Application;
use Zend\Expressive\Container;
use Zend\Expressive\Delegate;
use Zend\Expressive\Helper;
use Zend\Expressive\Middleware;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            'Zend\Expressive\Delegate\DefaultDelegate' => Delegate\NotFoundDelegate::class,
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class,
//Mail transport
            Zend\Mail\Transport\TransportInterface::class => Zend\Mail\Transport\Sendmail::class
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            Application::class => Container\ApplicationFactory::class,
            Delegate\NotFoundDelegate::class => Container\NotFoundDelegateFactory::class,
            Helper\ServerUrlMiddleware::class => Helper\ServerUrlMiddlewareFactory::class,
            Helper\UrlHelper::class => Helper\UrlHelperFactory::class,
            Helper\UrlHelperMiddleware::class => Helper\UrlHelperMiddlewareFactory::class,
            Zend\Stratigility\Middleware\ErrorHandler::class => Container\ErrorHandlerFactory::class,
            Middleware\ErrorResponseGenerator::class => Container\ErrorResponseGeneratorFactory::class,
            Middleware\NotFoundHandler::class => Container\NotFoundHandlerFactory::class,
            //Mongo factory
            Doctrine\ODM\MongoDB\DocumentManager::class => App\Factory\MongoDB\MongoDocumentManagerFactory::class,
            //Options
            \App\Options\UserServiceOptions::class => \App\Factory\UserServiceOptionsFactory::class,
            //Translator
            Zend\I18n\Translator\TranslatorInterface::class => Zend\I18n\Translator\TranslatorServiceFactory::class,
        ],
        'abstract_factories' => [
            App\Factory\AbstractServiceFactory::class,
            App\Factory\AbstractOptionsFactory::class,
        ],
        'delegators' => [
            Zend\I18n\Translator\TranslatorInterface::class => [
                \App\Factory\Delegator\TranslatorDelegatorFactory::class
            ],
        ],
    ],
];
