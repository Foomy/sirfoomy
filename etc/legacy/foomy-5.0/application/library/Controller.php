<?php

/**
 * Base controller
 *
 * @package default
 * @subpackage library
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Base_Controller extends Zend_Controller_Action
{
	protected $_request = null;
	protected $_auth    = null;
	protected $_logger  = null;

	public function init()
	{
		parent::init();

		$this->_request = $this->getRequest();

		$this->_auth = Zend_Auth::getInstance();
		$this->view->auth = $this->_auth;

		$this->initLogger();
	}// init()

	protected function initLogger()
	{
		$writer = new Zend_Log_Writer_Firebug();

		$this->_logger = new Zend_Log();
		$this->_logger->addWriter($writer);
	}
}
