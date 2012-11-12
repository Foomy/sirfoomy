<?php

/**
 * Application bootstrap.
 *
 * @author		Sascha Schneider <foomy.code@arcor.de>
 *
 * @category	application
 * @package		Bootstrap
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
	}

	/**
	 * Initialises the routes using the configuration file.
	 */
	protected function _initRouter()
	{
		$front = Zend_Controller_Front::getInstance();

		$cfgPath = $this->getOption('configPath');
		$config = new Zend_Config_Ini($cfgPath . 'routes.ini', 'production');

		$router = $front->getRouter();
		$router->addConfig($config, 'routes');
	}

	/**
	 * Initialises the view.
	 *
	 * @return Zend_View $view   The View Object.
	 */
	public function _initView()
	{
		$view = new Zend_View();
		$view->doctype('HTML5');
		$view->headTitle('Foomys Welt');

		$view->headMeta()->setCharset('UTF-8');

		$view->layout = 'default';

		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->setView($view);

		// @todo set sublayout dynamicaly
		$view->subLayout = 'standard';

		return $view;
	}

	protected function _initHelper()
	{
		Zend_Controller_Action_HelperBroker::addPrefix('Foo_Controller_Action_Helper');
		Zend_Controller_Action_HelperBroker::addPath(
			APPLICATION_PATH . '/../library/Foo/Controller/Action/Helper',
			'Foo_Controller_Action_Helper'
		);
	}

	/**
	 * Initialises the date/timezone settings.
	 *
	 * @return void
	 */
	public function _initTimezone()
	{
		// Set date/time zone
		date_default_timezone_set('Europe/Berlin');
	}
}