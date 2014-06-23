<?php

class Model_Wimip_Table extends Model_Table_Abstract
{
	const T_NAME = 'wimip';

	const F_IPV4        = 'ip_v4';
	const F_USERAGENT   = 'useragent';

	protected $_name        = self::T_NAME;
	protected $_primary     = self::F_ID;
	protected $_rowClass    = 'Model_Wimip_Table_Row';
	protected $_sequence    = true;

	private static $_instance = null;

	/**
	 * Singelton Pattern: Returns an instance of this class.
	 *
	 * @param	void
	 * @return	Model_Magazine_Table
	 */
	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Returns a single row identified by it's ID.
	 *
	 * @param	int $id
	 * @return	Model_Magazine_Table_Row
	 */
	public function findById($id, $includeInactive = false)
	{
		$select = $this->select();
		$select->where($this->quote(self::F_ID) . '=?', $id);

		if (! $includeInactive) {
			$select->where($this->quote(self::F_ACTIVE) . '=?', 1);
		}

		return $this->fetchRow($select);
	}

	/**
	 * Checks, whether a IP address is already stored.
	 *
	 * @param $ipv4 The IPv4 address to check.
	 * @return bool
	 */
	public function ipv4Exists($ipv4)
	{
		$sql = 'SELECT 1 FROM ' . self::T_NAME;
		return (bool)$this->getAdapter()->fetchOne($sql);
	}

	/**
	 * Returns a rowset with all entries stored in the table.
	 *
	 * @param	int $limit		Optional! Default: 0
	 * @param	int $offset		Optional! Default: 0
	 * @param	array $order	Optional! Default: ID-Field ascending
	 * @return	Zend_Db_Table_Rowset_Abstract
	 */
	public function getAll($limit = 0, $offset = 0, array $order = array())
	{
		if ((! isset($order['field'])) || empty($order['field'])) {
			$order['field'] = self::F_ID;
		}

		if ((! isset($order['direction'])) || empty($order['direction'])) {
			$order['direction'] = self::ASC;
		}

		$select = $this->select();
		$select->order($order['field'] . $order['direction']);
		$select->limit((int)$limit, (int)$offset);

		return $this->fetchAll($select);
	}

	/**
	 * Returns a rowset with all entries stored in the table.
	 *
	 * @param	int $limit		Optional! Default: 0
	 * @param	int $offset		Optional! Default: 0
	 * @param	array $order	Optional! Default: ID-Field ascending
	 * @return	Zend_Paginator
	 */
	public function getAllPaged($pageNumber, $itemCountPerPage, array $order = array())
	{
		if ((! isset($order['field'])) || empty($order['field'])) {
			$order['field'] = self::F_ID;
		}

		if ((! isset($order['direction'])) || empty($order['direction'])) {
			$order['direction'] = self::ASC;
		}

		$select = $this->select();
		$select->order($order['field'] . $order['direction']);

		$paginator = $this->getPaginator($select);
		$paginator->setCurrentPageNumber($pageNumber);
		$paginator->setItemCountPerPage($itemCountPerPage);

		return $paginator;
	}

}