<?php

/**
 * Table row class for the menu model.
 *
 * @package default
 * @subpackage model
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

class Foomy_Model_Menu extends Zend_Db_Table_Row_Abstract {

  protected $_primary = Foomy_Model_Menu_Peer::F_ID;

  /**
   * Return the menuitem id.
   *
   * @return int
   */
  public function getId() {
    return($this->{Foomy_Model_Menu_Peer::F_ID});
  }

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Model_Menu_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Model_Menu_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the menu name.
   *
   * @return string
   */
  public function getName() {
    return($this->{Foomy_Model_Menu_Peer::F_NAME});
  }

  /**
   * Sets the menu name to the given value.
   *
   * @param string name
   * @return Zend_Db_Table_Row
   */
  public function setName($name) {
    if ( isset($name) && (! empty($name)) ) {
      $this->{Foomy_Model_Menu_Peer::F_NAME} = $name;
    }
    return($this);
  }// setName() 

  /**
   * Returns the page_id of the menuitem.
   *
   * @return int
   */
  public function getAccessLevel() {
    return((int)$this->{Foomy_Model_Menu_Peer::F_ACCESS_LEVEL});
  }

  /**
   * Returns the items of the menu, or null if
   * there are no items found.
   *
   * @param void
   * @return Zend_Db_Table_Rowset
   */
  public function getItems() {
    return(Foomy_Model_Menu_Peer::getItemsByMenu($this->{Foomy_Model_Menu_Peer::F_ID}));
  }// getItems()
} 
