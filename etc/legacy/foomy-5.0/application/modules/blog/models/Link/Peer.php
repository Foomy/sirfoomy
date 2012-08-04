<?php

/**
 * Table class for the links.
 *
 * @package blog
 * @subpackage model
 * @version  5.0
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

class Foomy_Blog_Model_Link_Peer extends Zend_Db_Table_Abstract {

  const DEBUG = false;

  const T_NAME = 'link';

  const F_ID          = 'id';
  const F_CREATED     = 'created';
  const F_MODIFIED    = 'modified';
  const F_HREF        = 'href';
  const F_LINKTEXT    = 'linktext';
  const F_DESCRIPTION = 'description';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Blog_Model_Link';
  protected $_sequence = true;

  protected $_dependentTables = array('Foomy_Blog_Model_Article2Link_Peer');

  protected static $instance = null;

  /**
   * Returns an instance of the link table.
   *
   * @return Foomy_Blog_Model_Link_Peer
   */
  public static function getInstance() {
    if ( self::$instance===null ) {
      self::$instance = new self();
    }
    return(self::$instance);
  }// getInstance()
}
