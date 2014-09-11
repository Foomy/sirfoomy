<?php

require_once 'Zend/View/Interface.php';

/**
 * This helper loads the stylesheets for
 * the skin passed to it.
 *
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * @category    Foomy-5.2
 * @package     Zend_View_Helper
 * @subpackage  LoadJavascripts
 *
 * @version 0.1
 */

class Zend_View_Helper_LoadJavascripts
{
	const JAVASCRIPT_STANDARD_FOLDER = 'js/';

	/**
	 * @var Zend_View_Interface
	 */
	private $view;

	/**
	 *
	 */
	public function loadJavascripts()
	{
		$config = new Zend_Config_Xml('./' . self::JAVASCRIPT_STANDARD_FOLDER . '/javascript.xml');
		$javascripts = current($config->folders->toArray());

		if (is_array($javascripts)) {
			foreach ($javascripts['files'] as $file) {
				$this->view->headScript()->appendFile($javascripts['path'] . $file, 'text/javascript');
			}
		}

		return null;
	}

	/**
	 * Sets the view field
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}
}


