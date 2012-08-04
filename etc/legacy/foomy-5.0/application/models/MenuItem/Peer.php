<?php

/**
 * Table class for the menu item model.
 *
 * @package default
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +----------+------------------+------+-----+---------------------+----------------+
 * | Field    | Type             | Null | Key | Default             | Extra          |
 * +----------+------------------+------+-----+---------------------+----------------+
 * | id       | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 * | menu_id  | int(10) unsigned | YES  |     | NULL                |                |
 * | created  | timestamp        | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 * | label    | varchar(250)     | YES  |     | NULL                |                |
 * | page_id  | int(11)          | YES  |     | NULL                |                |
 * | link     | varchar(250)     | YES  |     | NULL                |                |
 * | position | int(11)          | YES  |     | NULL                |                |
 * +----------+------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_MenuItem_Peer extends Zend_Db_Table_Abstract {

  const T_NAME = 'menuitem';

  const F_ID       = 'id';
  const F_MENU_ID  = 'menu_id';
  const F_CREATED  = 'created';
  const F_MODIFIED = 'modified';
  const F_LABEL    = 'label';
  const F_PAGE_ID  = 'page_id';
  const F_POSITION = 'position';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Model_MenuItem';
  protected $_sequence = true;

  protected $_referenceMap = array(
    'Menu' => array(
      'columns'       => array(self::F_MENU_ID),
      'refTableClass' => 'Foomy_Model_Menu_Peer',
      'refColumns'    => array(Foomy_Model_Menu_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::RESTRICT
    )
  );

  private static $_instance = null;

  /**
   * Returns an instance of the menu item table.
   *
   * @param void
   * @return Foomy_Model_MenuItem_Peer
   */
  public static function getInstance() {
    if ( self::$_instance===null ) {
      self::$_instance = new self();
    }
    return(self::$_instance);
  }// getInstance()

  /**
   * Returns a rowset with the menu items of a specified menu,
   * or null if there are no item found for the menu.
   *
   * @param int $menuId
   * @return Zend_Db_Table_Rowset | null
   */
  public static function getItemsByMenu($menuId) {
    $select = self::getInstance()->select();
    $select->where('menu_id=?', $menuId);
    $select->order('position');

    $items = self::getInstance()->fetchAll($select);
    if ( $items->count()>0 ) {
      return($items);
    }
    return(null);
  }// getItemsByMenu()
}
