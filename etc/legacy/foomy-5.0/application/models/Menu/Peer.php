<?php

/**
 * Table class for the menu model.
 *
 * @package default
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +--------------+------------------+------+-----+---------------------+----------------+
 * | Field        | Type             | Null | Key | Default             | Extra          |
 * +--------------+------------------+------+-----+---------------------+----------------+
 * | id           | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created      | timestamp        | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified     | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 * | name         | varchar(50)      | YES  |     | NULL                |                |
 * | access_level | varchar(50)      | YES  |     | NULL                |                |
 * +--------------+------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_Menu_Peer extends Zend_Db_Table_Abstract {

  const T_NAME = 'menu';

  const F_ID           = 'id';
  const F_CREATED      = 'created';
  const F_MODIFIED     = 'modified';
  const F_NAME         = 'name';
  const F_ACCESS_LEVEL = 'access_level';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Model_Menu';
  protected $_sequence = true;

  protected $_dependentTables = array('Foomy_Model_MenuItem_Peer');
  protected $_referenceMap    = array(
    'Menu' => array(
      'columns'       => array('parent_id'),
      'refTableClass' => 'Foomy_Model_Menu_Peer',
      'refColumns'    => array(self::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::RESTRICT
    )
  );

  private static $_instance = null;

  /**
   * Returns an instance of the menu table.
   *
   * @param void
   * @return Foomy_Model_Menu_Peer
   */
  public static function getInstance() {
    if ( self::$_instance===null ) {
      self::$_instance = new self();
    }
    return(self::$_instance);
  }

  /**
   * Returns a menu identified by its database id.
   *
   * @param int $id
   * @return Foomy_Model_Menu
   */
  public static function getById($id) {
    $select = self::getInstance()->select();
    $select->where(self::F_ID.'=?', $id);
    return(self::getInstance()->fetchRow($select));
  }// getById()

  /**
   * Returns a list with all menus.
   *
   * @param void
   * @return Zend_Db_Table_Rowset | null
   */
  public static function getList() {
    $select = self::getInstance()->select();
    $select->order('name');
    $menus = self::getInstance()->fetchAll($select);
    if ( $menus->count()>0 ) {
      return($menus);
    }
    return(null);
  }// getMenus()
}
