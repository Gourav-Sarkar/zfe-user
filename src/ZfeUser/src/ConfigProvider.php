<?php

namespace ZfeUser;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{

    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
                Action\PingAction::class => Action\PingAction::class,
                //Mail transport
                \Zend\Mail\Transport\TransportInterface::class => \Zend\Mail\Transport\Sendmail::class,
                Hateoas\Jsonapi\Hydrator\UserHydrator::class=> Hateoas\Jsonapi\Hydrator\UserHydrator::class,
                Hateoas\Jsonapi\Hydrator\RoleHydrator::class=> Hateoas\Jsonapi\Hydrator\RoleHydrator::class,
                
                //Middleware
                Middleware\JsonApiDispatcherMiddleware::class => Middleware\JsonApiDispatcherMiddleware::class
            ],
            'factories' => [
                 //Mongo factory
                \Doctrine\ODM\MongoDB\DocumentManager::class => Factory\MongoDB\MongoDocumentManagerFactory::class,

               //Options
                \ZfeUser\Options\UserServiceOptions::class => Factory\UserServiceOptionsFactory::class,
                //Translator
                \Zend\I18n\Translator\TranslatorInterface::class => \Zend\I18n\Translator\TranslatorServiceFactory::class,
                //Mail transporter
                \ZfeUser\Service\MailerTemplateInterface::class => \Zend\Expressive\ZendView\ZendViewRendererFactory::class,

                //Middleware intercepter
                Middleware\AuthValidatorMiddleware::class => Factory\Middleware\AuthValidatorMiddlewareFactory::class,
                
                //Social Provider
                \Facebook\Facebook::class => Factory\MongoDB\SocialFacebookFactory::class,
                          

                Action\HomePageAction::class => Action\HomePageFactory::class,
                
            ],
            'abstract_factories' => [
                Factory\AbstractServiceFactory::class,
                Factory\AbstractOptionsFactory::class,
                Factory\AbstractActionFactory::class,
                Factory\AbstractDocumentfactory::class,
                Factory\AbstractTransformerFactory::class,
               // Factory\AbstractMiddlewareFactory::class,
            ],
            /*
            'delegators' => [
                \Zend\I18n\Translator\TranslatorInterface::class => [
                    Factory\Delegator\TranslatorDelegatorFactory::class
                ],
            ],
             *
             */
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'error' => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
                'mail' => [__DIR__ . '/../templates/mail'],
            ],
        ];
    }
}
