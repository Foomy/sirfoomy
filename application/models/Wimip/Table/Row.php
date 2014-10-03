<?php

class Model_Wimip_Table_Row extends Model_Table_Row_Abstract
{
	public function getIpv4()
	{
		return $this->{Model_Wimip_Table::F_IPV4};
	}

	public function setIpv4($ipv4)
	{
		$this->{Model_Wimip_Table::F_IPV4} = $ipv4;
	}

	public function getIpv6()
	{
		return $this->{Model_Wimip_Table::F_IPV6};
	}

	public function setIpv6($ipv6)
	{
		$this->{Model_Wimip_Table::F_IPV6} = $ipv6;
	}

	public function getLastSeen()
	{
		$date = new Zend_Date($this->{Model_Wimip_Table::F_LAST_SEEN});
		return $date->get('dd.MM.Y HH:mm:ss');
	}

	public function setLastSeen($lastSeen)
	{
		$this->{Model_Wimip_Table::F_LAST_SEEN} = $lastSeen;
	}

	public function getUseragent()
	{
		return $this->{Model_Wimip_Table::F_USERAGENT};
	}

	public function setUseragent($useragent)
	{
		$this->{Model_Wimip_Table::F_USERAGENT} = $useragent;
	}
}