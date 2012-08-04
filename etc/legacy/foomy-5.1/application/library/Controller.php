<?php

/**
 * Base controller
 *
 * @package default
 * @subpackage library
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Base_Controller extends Zend_Controller_Action
{
    protected $_request  = null;
    protected $_auth     = null;
    protected $_logger   = null;
    protected $_isSplash;

    public function preDispatch()
    {
        $this->view->render('placeholders/_rightbox.phtml');
    }

    public function init()
    {
        parent::init();

        $this->_request = $this->getRequest();

        $this->_auth = Zend_Auth::getInstance();
        $this->view->auth = $this->_auth;

        // Are we on the splash screen?
        if ( $_SERVER['REQUEST_URI']=='/' ) {
            $this->_isSplash = true;
        } else {
            $this->_isSplash = false;
        }
        $this->view->isSplash = $this->_isSplash;

        $this->initLogger();
    }// init()

    protected function initLogger()
    {
        $writer = new Zend_Log_Writer_Firebug();

        $this->_logger = new Zend_Log();
        $this->_logger->addWriter($writer);
    }
}
