<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Bootstrap autoloader for application resources
	 *
	 * @return Zend_Application_Module_Autoloader
	 */
	//    protected function _initAutoload()
	//    {
	//        $config = $this->getOption('autoloader');
	//        $autoloader = new Zend_Loader_Autoloader_Resource($config);
	//
	//        return $autoloader;
	//    }

	/**
	 * Initializes the view
	 *
	 * return Zend_View
	 */
	protected function _initView()
	{
		$view = new Zend_View();
		$view->doctype('XHTML1_STRICT');
		$view->headTitle('Foomys Welt 5.1');
		$view->headScript()->appendFile('/js/jquery.js', 'text/javascript');
		$view->headScript()->appendFile('/js/main.js', 'text/javascript');

		$view->headLink(array(
			'rel'  => 'shortcut icon',
			'href' => '/img/favicon.ico',
			'type' => 'image/x-icon',
			'PREPEND',
		));
		$view->skin = 'default';

		// Add the view to the ViewRenderer...
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
			'ViewRenderer'
		);
		$viewRenderer->setView($view);

		// ...and return it, so that it can be stored by the bootstrap
		return $view;
	}

	/**
	 * Initializes the navigation
	 */
	protected function _initNavigation()
	{
		$cfg = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml', 'nav');
		$nav = new Zend_Navigation($cfg);

		$view = $this->getResource('view');
		$view->getHelper('navigation')->navigation($nav);
	}

	/**
	 * Initializes the placeholder for the right sidebar
	 */
	protected function _initRightbox()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');

		$view->placeholder('rightbox')->setPrefix("<div id=\"rightbox\">\n    <div class=\"section\">\n")
		->setSeparator("</div>\n    <div class=\"section\">\n")
		->setPostfix("    </div>\n</div>");
	}
}

