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

		/** @var $table Model_Wimip_Table */
		$table = Model_Wimip_Table::getInstance();

		if (false !== strpos($useragent, 'SirFoomy')) {
            if (null === ($row = $table->findByIpv4($remoteIp))) {
				/** @var $row Model_Wimip_Table_Row */
                $row = $table->createRow();
				$row->setIpv4($remoteIp);
				$row->setUseragent($useragent);
			}
            else {
                $row->setLastSeen(date('Y-m-d H:i:s')); 
            }

			$row->save();
		}

		$list = $table->getAll(0,0,array(
			'field' => 'id',
			'direction' => Model_Wimip_Table::DESC
		));

		$this->view->remoteIp = $remoteIp;
		$this->view->useragent = $useragent;
		$this->view->list = $list;
		$this->view->fieldList = $table->getFieldList();
	}
}
