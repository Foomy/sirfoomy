<?php

/**
 * Table row class for the links.
 * An instance of this class represents a link.
 *
 * @package blog
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +-------------+---------------------+------+-----+---------------------+----------------+
 * | Field       | Type                | Null | Key | Default             | Extra          |
 * +-------------+---------------------+------+-----+---------------------+----------------+
 * | id          | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created     | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified    | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | href        | varchar(255)        | NO   |     | NULL                |                |
 * | linktext    | varchar(255)        | NO   |     | NULL                |                |
 * | description | varchar(255)        | YES  |     | NULL                |                |
 * +-------------+---------------------+------+-----+---------------------+----------------+
 */

class Foomy_Blog_Model_Link extends Zend_Db_Table_Row_Abstract {

  const DEBUG = false;

  protected $_primary = Foomy_Blog_Model_Link_Peer::F_ID;

  /**
   * Returns the database id of the link.
   *
   * return int
   */
  public function getId() {
    return($this->{Foomy_Blog_Model_Link_Peer::F_ID});
  }// getId()

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Blog_Model_Link_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Blog_Model_Link_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the hyper reference for the link.
   *
   * @return string
   */
  public function getHref() {
    return($this->{Foomy_Blog_Model_Link_Peer::F_HREF});
  }// getHref()

  /**
   * Returns the linktext.
   *
   * @return string
   */
  public function getLinkText() {
    return($this->{Foomy_Blog_Model_Link_Peer::F_LINKTEXT});
  }// getLinkText()

  /**
   * Returns the description for the link.
   *
   * @return string
   */
  public function getDescription() {
    return($this->{Foomy_Blog_Model_Link_Peer::F_DESCRIPTION});
  }// getDescription()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  James T. Kirk, Star Trek VI - The unentdeckte Land
 */
