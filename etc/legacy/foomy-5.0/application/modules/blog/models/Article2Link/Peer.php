<?php

/**
 * Table class for the article and link intersection table.
 *
 * @package blog
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +------------+------------------+------+-----+---------+----------------+
 * | Field      | Type             | Null | Key | Default | Extra          |
 * +------------+------------------+------+-----+---------+----------------+
 * | id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
 * | article_id | int(10) unsigned | NO   |     | NULL    |                |
 * | link_id    | int(10) unsigned | NO   |     | NULL    |                |
 * +------------+------------------+------+-----+---------+----------------+
 */

class Foomy_Blog_Model_Article2Link_Peer extends Zend_Db_Table_Abstract {

  const DEBUG = false;

  const T_NAME = 'article2link';

  const F_ID         = 'id';
  const F_ARTICLE_ID = 'article_id';
  const F_LINK_ID    = 'link_id';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_sequence = true;

  protected $_referenceMap = array(
    'Article' => array(
      'columns'       => array(self::F_ARTICLE_ID),
      'refTableClass' => 'Foomy_Blog_Model_Article_Peer',
      'refColumns'    => array(Foomy_Blog_Model_Article_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::CASCADE
    ),
    'Link'    => array(
      'columns'       => array(self::F_LINK_ID),
      'refTableClass' => 'Foomy_Blog_Model_Link_Peer',
      'refColumns'    => array(Foomy_Blog_Model_Link_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::CASCADE
    )
  );

  protected static $instance = null;

  public static function getInstance() {
    if ( self::$instance===null ) {
      self::$instance = new self();
    }
    return(self::$instance);
  }// getInstance()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  James T. Kirk, Star Trek VI - Das unentdeckte Land
 */
