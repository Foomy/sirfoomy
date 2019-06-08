<?php

/**
 * Table row class for the menu item model.
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

class Foomy_Model_MenuItem extends Zend_Db_Table_Row_Abstract {

  protected $_primary = Foomy_Model_MenuItem_Peer::F_ID;

  /**
   * Return the menuitem id.
   *
   * @return int
   */
  public function getId() {
    return($this->{Foomy_Model_MenuItem_Peer::F_ID});
  }

  /**
   * Return the id of the menu the menuitem belongs to.
   *
   * @return int
   */
  public function getMenuId() {
    return($this->{Foomy_Model_MenuItem_Peer::F_MENU_ID});
  }

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Model_MenuItem_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Model_MenuItem_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the menuitem label.
   *
   * @return string
   */
  public function getLabel() {
    return($this->{Foomy_Model_MenuItem_Peer::F_LABEL});
  }

  /**
   * Returns the page_id of the menuitem.
   *
   * @return int
   */
  public function getPageId() {
    return((int)$this->{Foomy_Model_MenuItem_Peer::F_PAGE_ID});
  }

  /**
   * Returns the menuitem link.
   *
   * @return string
   */
  public function getLink() {
    return($this->{Foomy_Model_MenuItem_Peer::F_LINK});
  }

  /**
   * Returns the menuitem position.
   *
   * @return int
   */
  public function getPosition() {
    return($this->{Foomy_Model_MenuItem_Peer::F_POSITION});
  }
} 
