<?php

namespace Application;

return array(
  'router'          => array(
    'routes' => array(
      'home'        => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/',
          'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'index',
          ),
        ),
      ),
      'contact'        => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/contact/',
          'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'contact',
          ),
        ),
      ),
      'legal-notice'        => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/legal-notice/',
          'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'legal-notice',
          ),
        ),
      ),
      'privacy'        => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/privacy/',
          'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'privacy',
          ),
        ),
      ),
      'faq'        => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/faq/',
          'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'faq',
          ),
        ),
      ),
      'about-blank' => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/about/',
          'defaults' => array(
            'controller' => 'Application\Controller\Index',
            'action'     => 'index',
          ),
        ),
      ),
      'about-cv' => array(
        'type'    => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route'    => '/curriculum-vitae/',
          'defaults' => array(
            'controller' => 'Application\Controller\About',
            'action'     => 'curriculum-vitae',
          ),
        ),
      ),
      // The following is a route to simplify getting started creating
      // new controllers and actions without needing to create a new
      // module. Simply drop new controllers in, and you can access them
      // using the path /application/:controller/:action
      'application' => array(
        'type'          => 'Literal',
        'options'       => array(
          'route'    => '/application',
          'defaults' => array(
            '__NAMESPACE__' => 'Application\Controller',
            'controller'    => 'Index',
            'action'        => 'index',
          ),
        ),
        'may_terminate' => true,
        'child_routes'  => array(
          'default' => array(
            'type'    => 'Segment',
            'options' => array(
              'route'       => '/[:controller[/:action]]',
              'constraints' => array(
                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
              ),
              'defaults'    => array(),
            ),
          ),
        ),
      ),
    ),
  ),
  'service_manager' => array(
    'abstract_factories' => array(
      'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
      'Zend\Log\LoggerAbstractServiceFactory',
    ),
    'factories'          => array(
      'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
      'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
    ),
  ),
  'translator'      => array(
    'locale'                    => 'en_US',
    'translation_file_patterns' => array(
      array(
        'type'     => 'gettext',
        'base_dir' => __DIR__ . '/../language',
        'pattern'  => '%s.mo',
      ),
    ),
  ),
  'controllers'     => array(
    'invokables' => array(
      'Application\Controller\Index' => Controller\IndexController::class,
      'Application\Controller\About' => Controller\AboutController::class
    ),
  ),
  'view_manager'    => array(
    'display_not_found_reason' => true,
    'display_exceptions'       => true,
    'doctype'                  => 'HTML5',
    'not_found_template'       => 'error/404',
    'exception_template'       => 'error/index',
    'template_map'             => array(
      'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
      'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
      'error/404'               => __DIR__ . '/../view/error/404.phtml',
      'error/index'             => __DIR__ . '/../view/error/index.phtml',
    ),
    'template_path_stack'      => array(
      __DIR__ . '/../view',
    ),
  ),
  'view_helpers'    => array(
    'invokables' => array(
      'loadSkin'   => 'Foo\View\Helper\LoadSkin',
      'loadScripts' => 'Foo\View\Helper\LoadScripts',
    )
  ),
  'navigation'      => array(
    'default' => array(
      array(
        'label' => 'Home',
        'route' => 'home'
      ),
      array(
        'label' => 'Über mich',
        'route' => 'about-blank',
        'class' => 'dropdown',
        'pages' => array(
          array(
            'label' => 'Lebenslauf',
            'route' => 'about-cv'
          )
        )
      )
    )
  ),
  // Placeholder for console routes
  'console'         => array(
    'router' => array(
      'routes' => array(),
    ),
  ),
);
