<?php
class IndexController extends Zend_Controller_Action
{
	public function init()
	{
	}

	public function indexAction()
	{
		$this->view->layout = 'onecol';
	}

	public function jokeAction()
	{
		$this->view->layout = 'onecol';
	}

	public function riddleAction()
	{
		$this->view->layout = 'onecol';
	}

	public function impressAction()
	{
	}

	public function wimipAction()
	{
		$remoteIp  = $_SERVER['REMOTE_ADDR'];
		$useragent = $_SERVER['HTTP_USER_AGENT'];

		if (false !== strpos($useragent, 'SirFoomy')) {
/*
			$file = realpath(APPLICATION_PATH . '/../wimip') . '/addresses.txt';
			$fh   = fopen($file, 'a+');
			fwrite($fh, "$remoteIp\n");
			fclose($fh);
*/

			/** @var $table Model_Wimip_Table */
			$table = Model_Wimip_Table::getInstance();
var_dump($table->ipv4Exists($remoteIp));
			if (! $table->ipv4Exists($remoteIp)) {
				/** @var $row Model_Wimip_Table_Row */
				$row = $table->createRow();
				$row->setIpv4($remoteIp);
				$row->setUseragent($useragent);
				$row->save();
			}
		}

		$this->view->remoteIp = $remoteIp;
		$this->view->useragent = $useragent;
	}
}
