<?php

/**
 * Abstract class for db table rows.
 *
 * @author      Sascha Schneider <sascha.schneider@netsdirekt.de>
 *
 * @category    model
 * @package     Model_Table_Row_Abstract
 */
class Model_Table_Row_Abstract extends Zend_Db_Table_Row_Abstract
{
	protected $_primary = Model_Table_Abstract::F_ID;

	/**
	 * Returns the database id.
	 *
	 * @return  int $id
	 */
	public function getId()
	{
		return (int)$this->{Model_Table_Abstract::F_ID};
	}

	/**
	 * Returns the creation datetime of the data record.
	 *
	 * @return  string $creationDate
	 */
	public function wasCreatedOn()
	{
		$date = new Zend_Date($this->{Model_Table_Abstract::F_CREATED});
		return $date->get('dd.MM.Y HH:mm:ss');
	}

	/**
	 * Returns the datetime of the last modification.
	 *
	 * @return  string $modificationDate
	 */
	public function lastModifiedOn()
	{
		if ('0000-00-00 00:00:00' !== $this->{Model_Table_Abstract::F_MODIFIED}) {
			$date = new Zend_Date($this->{Model_Table_Abstract::F_MODIFIED});
			return $date->get('dd.MM.Y HH:mm:ss');
		}

		return '';
	}

	/**
	 * Sets the modification field to the actual datetime.
	 */
	public function setJustModified()
	{
		$datetime = date('Y-m-d h:i:s');
		$this->setLastModified($datetime);
	}
}
