<?php

/**
 * Table row class for the article and tag intersection table.
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
 * | tag_id     | int(10) unsigned | NO   |     | NULL    |                |
 * +------------+------------------+------+-----+---------+----------------+
 */

class Foomy_Blog_Model_Article2Tag_Peer extends Zend_Db_Table_Abstract {

  const T_NAME = 'article2tag';

  const F_ID         = 'id';
  const F_ARTICLE_ID = 'article_id';
  const F_TAG_ID     = 'tag_id';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_sequence = true;

  protected $_referenceMap = array(
    'Article' => array(
      'columns'       => array(self::F_ARTICLE_ID),
      'refTableClass' => 'Foomy_Blog_Model_Article_Peer',
      'refColums'     => array(Foomy_Blog_Model_Article_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::CASCADE
    ),
    'Tag' => array(
      'columns'        => array(self::F_TAG_ID),
      'refTableClass' => 'Foomy_Model_Tag_Peer',
      'refColumns'    => array(Foomy_Model_Tag_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::CASCADE
    )
  );

  protected static $instance = null;

  /**
   * Returns an instance of the blog article/tag intersection table.
   *
   * @param void
   * @return Foomy_Blog_Model_Article2Tag_Peer
   */
  public static function getInstance() {
    if ( self::$instance===null ) {
      self::$instance = new self();
    }
    return(self::$instance);
  }// getInstance()
  
}

/**
 * "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 * (James T. Kirk, Star Trek VI - Das unedeckte Land)
 */
