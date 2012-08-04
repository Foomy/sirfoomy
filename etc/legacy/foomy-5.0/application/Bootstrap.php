<?php

/**
 * Application bootstrap
 *
 * @package default
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Bootstrap autoloader for application resources
     *
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
        $config = $this->getOption('autoloader');
        $autoloader = new Zend_Loader_Autoloader_Resource($config);

        return $autoloader;
    }// _initAutoloader()

    /**
     * Initialises the view
     *
     * @return Zend_View
     */
    protected function _initView()
    {
        $view = new Zend_View();

        // Are we on the splash screen?
        if ( $_SERVER['REQUEST_URI']=='/' ) {
            $view->isSplash = true;
        } else {
            $view->isSplash = false;
        }

        // Bootstraping dbAdapter
        $this->bootstrap('db');
        $view->db = $this->getResource('db');
    
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);

        // Set the path to the viewhelpers of the Candlekeep-Library
        $view->setHelperPath(APPLICATION_PATH.'/../library/Candlekeep/View/Helper/', 'Candlekeep_View_Helper');

        // Return it, so that it can be stored by the bootstrap
        return $view;
    }// _initView() 

    /**
     * Set the document metadata for the XHTML scripts.
     */
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('Foomys Welt 5.0');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
        $view->headMeta()->appendHttpEquiv('Content-Style-Type', 'text/css');
        $view->headMeta()->appendHttpEquiv('Content-Script-Type', 'text/javascript');
    }// _initDoctype()

    /**
     * Initialises the main navigation.
     */
    protected function _initNavigation()
    {
        $cfg = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml', 'nav');
        $nav = new Zend_Navigation($cfg);

        $view = $this->getResource('view');
        $view->getHelper('navigation')->navigation($nav);
    }// _initNavigation()

    /**
     * Starting session and init translation
     */
    protected function _initSession()
    {
        Zend_Session::start();
    }// _initSession()

    /**
     * Init translation
     */
    protected function _initTranslation()
    {
        $this->bootstrap('translate');
        $translate = $this->getResource('translate');
        $translate->addTranslation(APPLICATION_PATH.'/translations/de_DE.csv', 'de');
//    $translate->addTranslation(APPLICATION_PATH.'/translations/en_EN.csv', 'en');
        $this->view->translate = $translate;
    }// _initTranslation()

}
