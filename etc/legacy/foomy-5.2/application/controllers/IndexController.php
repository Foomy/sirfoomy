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

		$list = $table->getAll(0, 0, array(
			'field'     => 'last_seen',
			'direction' => Model_Wimip_Table::DESC
		));

		$this->view->remoteIp  = $remoteIp;
		$this->view->useragent = $useragent;
		$this->view->list      = $list;
		$this->view->fieldList = $table->getFieldList();
	}

	public function countdownAction()
	{
		$dateString      = '11.12.2014 15:10:00';
//		$dateString      = '01.01.2015 00:00:00';
		$targetTimestamp = strtotime($dateString);
		$secondTillDone  = $targetTimestamp - time();

		$css = array(
			'months is_months',
			'weeks is_weeks',
			'days is_days',
			'hours is_hours',
			'minutes is_minutes',
			'seconds is_seconds'
		);

		$timeElements = $this->seconds2TimeElements($secondTillDone);

		$this->view->css = $css;
		$this->view->timeElements = $timeElements;
	}

	/**
	 * @param $seconds
	 * @return array
	 */
	private function seconds2TimeElements($seconds)
	{
		$timeSpans = array(
			1 => 31449600,
			2 => 604800,
			3 => 86400,
			4 => 3600,
			5 => 60,
			6 => 1
		);

		$remaining   = $seconds;
		$retVal = array();
		foreach ($timeSpans as $spanIndex => $scale) {
			$chunk     = floor($remaining / $scale);
			$remaining = $remaining % $scale;

			$retVal[] = $chunk;
		}

		return $retVal;
	}
}
