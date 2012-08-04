<?php

/**
 * Table class for the blog model.
 *
 * @package blog
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | Field    | Type                | Null | Key | Default             | Extra          |
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | id       | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created  | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | title    | varchar(30)         | YES  |     | NULL                |                |
 * | subtitle | varchar(30)         | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 */

class Foomy_Blog_Model_Blog_Peer extends Zend_Db_Table_Abstract {

  const T_NAME = 'blog';

  const F_ID       = 'id';
  const F_CREATED  = 'created';
  const F_MODIFIED = 'modified';
  const F_TITLE    = 'title';
  const F_SUBTITLE = 'subtitle';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Blog_Model_Blog';
  protected $_sequence = true;

  protected $_dependentTables = array('Foomy_Blog_Model_Article_Peer');

  protected static $instance = null;

  /**
   * Returns an instance of the blog table.
   *
   * @param void
   * @return Foomy_Blog_Model_Blog_Peer
   */
  public static function getInstance() {
    if ( self::$instance===null ) {
      self::$instance = new Foomy_Blog_Model_Blog_Peer();
    }
    return(self::$instance);
  }// getInstance()

  /**
   * Returns a blog specified by its datatbase id.
   *
   * @param int $id
   * @return Foomy_Blog_Model_Blog
   */
  public static function getById($id) {
    $select = self::getInstance()->select();
    $select->where(self::F_ID.'=?', $id);
    return(self::getInstance()->fetchRow($select));
  }// getById()

  /**
   * Checks whether a blog, specified by its id, exists or not.
   *
   * @param int $blog_id
   * @return bool
   */
  public static function exists($blogId) {
    $dba = self::getInstance()->getAdapter();

    $sql = 'SELECT 1
              FROM '.self::T_NAME.'
             WHERE id='.$blogId;
    $res = $dba->fetchOne($sql);

    if ( (int)$res>0 ) {
      return(true);
    }
    return(false);
  }// exists()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
