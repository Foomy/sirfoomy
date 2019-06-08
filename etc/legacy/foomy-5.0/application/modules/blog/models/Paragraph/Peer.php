<?php

/**
 * Table class for an article paragraph.
 *
 * @package blog
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +---------------+--------------------------+------+-----+---------------------+----------------+
 * | Field         | Type                     | Null | Key | Default             | Extra          |
 * +---------------+--------------------------+------+-----+---------------------+----------------+
 * | id            | int(10) unsigned         | NO   | PRI | NULL                | auto_increment |
 * | article_id    | int(10) unsigned         | NO   |     | NULL                |                |
 * | created       | timestamp                | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified      | timestamp                | NO   |     | 0000-00-00 00:00:00 |                |
 * | type          | set('normal','abstract') | NO   |     | normal              |                |
 * | paragraphtext | text                     | YES  |     | NULL                |                |
 * +---------------+--------------------------+------+-----+---------------------+----------------+
 */

class Foomy_Blog_Model_Paragraph_Peer extends Zend_Db_Table_Abstract {

  const DEBUG = false;

  const T_NAME = 'paragraph';

  const F_ID            = 'id';
  const F_ARTICLE_ID    = 'article_id';
  const F_CREATED       = 'created';
  const F_MODIFIED      = 'modified';
  const F_TYPE          = 'type';
  const F_PARAGRAPHTEXT = 'paragraphtext';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Blog_Model_Paragraph';
  protected $_sequence = true;

  protected $_referenceMap = array(
    'Article' => array(
      'columns'       => array(self::F_ARTICLE_ID),
      'refTableClass' => 'Foomy_Blog_Model_Article_Peer',
      'refColumns'    => array(Foomy_Blog_Model_Article_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::CASCADE
    )
  );

  protected static $instance = null;

  /**
   * Returns an instance of the article table
   *
   * @param void
   * @return Foomy_Blog_Model_Paragraph_Peer
   */
  public static function getInstance() {
    if ( self::$instance===null ) {
      self::$instance = new self();
    }
    return(self::$instance);
  }// getInstance()

}

/**
 *  "Wenn wir noch was vermasseln können, sagt mir bescheid!"
 *  ("Let me know if there's some other way we can screw up tonight.")
 *
 *  James T. Kirk; Star Trek VI - Das unentdeckte Land
 */
