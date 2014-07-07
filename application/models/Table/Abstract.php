<?php

/**
 * Class Model_Table_Abstract
 *
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * @category    model
 * @package     Model_Table_Abstract
 */
class Model_Table_Abstract extends Zend_Db_Table_Abstract
{
	const ASC	= ' ASC';
	const DESC	= ' DESC';

	const F_ID			= 'id';
	const F_CREATED		= 'created_on';
	const F_MODIFIED	= 'last_modified';

	protected $page	= 1;
	protected $ipp	= 10;

	public function setPage($page)
	{
		$this->page = $page;
	}

	public function setIpp($ipp)
	{
		$this->ipp = $ipp;
	}

	/**
	 * Returns an instance of a table as selected
	 * by the parameter.
	 *
	 * @param   string $tableName
	 * @param   Model_Table_Abstract $table
	 * @return  Model_Table_Abstract
	 */
	public function getTable($tableName, Model_Table_Abstract $table = null)
	{
		if (null === $table) {
			if (strpos($tableName, '_')) {
				$tableName = Foo_String::create($tableName)->underscoreToCamelCased();
			}

			$className = 'Model_' . ucfirst($tableName) . '_Table';
			$table = $className::getInstance();
		}

		return $table;
	}

	/**
	 * Returns the table's column count.
	 *
	 * @return  int
	 */
	public function getColumnCount()
	{
		return count($this->info('cols'));
	}

	/**
	 * Returns the number of entries stored in the table.
	 *
	 * @return	int $count
	 */
	public function getEntryCount()
	{
		$select = $this->select();
		$select->from($this, array('count(*) as amount'));

		return reset($this->fetchRow($select)->toArray());
	}

	public function getFieldList()
	{
		$tableDef = $this->info(self::METADATA);
		$fieldList = array_keys($tableDef);

		return $fieldList;
	}

	/**
	 * Returns the default value for the given field
	 * as it is defined in the database.
	 *
	 * @param	type $column
	 * @return	string
	 */
	public function getDefaultValue($column)
	{
		$tableDef = $this->info(self::METADATA);

		if (array_key_exists($column, $tableDef)) {
			$fieldDef = $tableDef[$column];

			if (array_key_exists('DEFAULT', $fieldDef)) {
				return $fieldDef['DEFAULT'];
			}
		}

		return '';
	}

	/**
	 * Returns the options of the given enum field
	 * as they are defined in the database.
	 *
	 * @param	type $column
	 * @return	array|null
	 */
	public function getEnumOptions($column)
	{
		$tableDef = $this->info(self::METADATA);

		if (array_key_exists($column, $tableDef)) {
			$fieldDef = $tableDef[$column];

			if (array_key_exists('DATA_TYPE', $fieldDef) && (! empty($fieldDef['DATA_TYPE']))) {
				$optString = str_replace("'", '', substr($fieldDef['DATA_TYPE'], 5, -1));
				$opts = explode(',', $optString);

				foreach ($opts as $opt) {
					$options[$opt] = $opt;
				}

				return $options;
			}
		}

		return null;
	}

	/**
	 * Quotes a given string into backticks.
	 *
	 * @param   string $var
	 * @return  string
	 */
	public function quote($var)
	{
		return "`$var`";
	}

	/**
	 * Lazy initialization of the paginator.
	 *
	 * @param   Zend_Db_Table_Select $select
	 * @param   Zend_Paginator $paginator
	 * @param   Zend_Paginator_Adapter_DbTableSelect $adapter
	 * @return  Zend_Paginator
	 */
	protected function getPaginator(Zend_Db_Table_Select $select, Zend_Paginator $paginator = null, Zend_Paginator_Adapter_DbTableSelect $adapter = null)
	{
		if (null === $adapter) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
		}

		if (null === $paginator) {
			$paginator = new Zend_Paginator($adapter);
		}

		return $paginator;
	}

	/**
	 * Logs variables for debugging into streams defined in
	 * the application.ini.
	 *
	 * @param	mixed $var1		The variable you want to dump.
	 * @param	mixed var2 .. var<i>n</i>	Optional!
	 */
	protected function debug($var1, $var2 = null)
	{
		$argsCount = func_num_args();

		if ($argsCount > 1) {
			$args = func_get_args();
		}
		else {
			$args = array($var1);
		}

		$writer = new Zend_Log_Writer_Firebug();
//		$writer = new Zend_Log_Writer_Stream(realpath(APPLICATION_PATH . '/../logs/php.log'), 'a');
		$logger = new Zend_Log($writer);

		for ($i = 0; $i < count($args); $i++) {
			$logger->log($args[$i], Zend_Log::DEBUG);
		}
	}
}