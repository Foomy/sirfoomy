<?php

// ToDo: Db-Klasse nach PHP5 migrieren
class Db {
	protected $db, $host, $user, $pwd;

	private $sql;
	private $res;

	private $pointer;

	private $error;
	private $errno;
 
	function Db() {
		$this->error = '';
		$this->errno = 0;

		$this->_connect();
	}//constructor


	/** public methods
	 */
	function Qry() {
		if ( $this->res = mysql_query($this->sql) ) return(true);
		$this->error = mysql_error();
		$this->errno = mysql_errno();
		return(false);
	}
 
	function Fetch() {
		return(mysql_fetch_object($this->res));
	}
 
	function NumRows($res) {
		return(mysql_num_rows($this->res));
	}

 
	/** private methods
	 */
	function _connect() {
		$this->pointer = mysql_connect($this->host, $this->user, $this->pwd) || die('Connection Error');
		mysql_select_db($this->db) || die('Database not found!');
	}//_connect()
}
?>
