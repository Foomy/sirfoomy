<?php

/**
 * Table row class for the user role model.
 * An instance of this class represents a role.
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

class Foomy_Model_Role extends Zend_Db_Table_Row_Abstract {

  protected $_primary = Foomy_Model_Role_Peer::F_ID;

  /**
   * Returns the user id.
   *
   * @return int
   */
  public function getId() {
    return($this->{Foomy_Model_Role_Peer::F_ID});
  }// getId()

  /**
   * Returns the id of that role from which the role inherits.
   *
   * @return int
   */
  public function getRoleId() {
    return($this->{Foomy_Model_Role_Peer::F_ROLE_ID});
  }// getRoleId()

  /**
   * Sets the id of that role from which the role inherits.
   *
   * @param int $roleId
   * @return Foomy_Model_Role
   */
  public function setRoleId($roleId) {
    if ( isset($roleId) && (! empty($roleId)) ) {
      $this->{Foomy_Model_Role_Peer::F_ROLE_ID} = $roleId;
    }
    return($this);
  }// setRoleId()

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Model_Role_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Model_Role_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the role's name.
   *
   * @return string
   */
  public function getName() {
    return($this->{Foomy_Model_Role_Peer::F_NAME});
  }// getName()

  /**
   * Sets the role's name to the committed value.
   *
   * @param string $name
   * @return Foomy_Model_Role
   */
  public function setName($name) {
    if ( isset($name) && (! empty($name)) ) {
      $this->{Foomy_Model_Role_Peer::F_NAME} = $name;
    }
    return($this);
  }// setName()

  /**
   * Returns a description for the role.
   *
   * @return string
   */
  public function getDescription() {
    return($this->{Foomy_Model_Role_Peer::F_DESCRIPTION});
  }// getDescription()

  /**
   * sets the role's description to the committed value.
   *
   * @param string $desciption
   * @return Foomy_Model_Role
   */
  public function setDescription($description) {
    if ( isset($description) && (! empty($description)) ) {
      $this->{Foomy_Model_Role_Peer::F_DESCRIPTION} = $description;
    }
    return($this);
  }// setDescription()
}

/**
 * Wenn wir heute noch was vermasseln können, sagt mir bescheid!
 * (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
