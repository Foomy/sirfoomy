<?php

/**
 * Table class for the user role model.
 *
 * @package default
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +-------------+------------------+------+-----+---------------------+----------------+
 * | Field       | Type             | Null | Key | Default             | Extra          |
 * +-------------+------------------+------+-----+---------------------+----------------+
 * | id          | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created     | timestamp        | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified    | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 * | name        | varchar(25)      | NO   |     | NULL                |                |
 * | description | varchar(255)     | YES  |     | NULL                |                |
 * +-------------+------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_Role_Peer extends Zend_Db_Table_Abstract {

  const DEBUG = false;

  const T_NAME = 'role';

  const F_ID          = 'id';
  const F_ROLE_ID     = 'role_id';
  const F_CREATED     = 'created';
  const F_MODIFIED    = 'modiefied';
  const F_NAME        = 'name';
  const F_DESCRIPTION = 'description';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Model_Role';
  protected $_sequence = true;

  protected $_dependentTables = array('Foomy_Model_User_Peer');

  protected static $instance = null;

  /**
   * Returns an instance of the role table.
   *
   * @param void
   * @return Foomy_Model_Role_Peer
   */
  public static function getInstance() {
    if ( self::$instance===null ) {
      self::$instance = new self();
    }
    return(self::$instance);
  }// getInstance()

  /**
   * Returns a role object specified by its database id.
   *
   * @param int $id
   * @return Foomy_Model_Role
   */
  public static function getById($id) {
    $select = self::getInstance()->select();
    $select->where(self::F_ID.'=?', $id);
    return(self::getInstance()->fetchRow($select));
  }// getById();

  /**
   * Returns a list of all roles stored in the system.
   *
   * @return Zend_Db_Tabel_Rowset
   */
  public static function getList() {
    $select = self::getInstance()->select();
    return(self::getInstance()->fetchAll($select));
  }// getList()
}
