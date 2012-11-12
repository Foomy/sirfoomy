<?php
class IndexController extends Zend_Controller_Action
{
	public function init ()
	{
	}

	public function indexAction ()
	{
		$this->view->layout = 'onecol';
	}

	public function jokeAction()
	{
		$this->view->layout = 'onecol';
	}

	public function impressAction()
	{
	}
}
