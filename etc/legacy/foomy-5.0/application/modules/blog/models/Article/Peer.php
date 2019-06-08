<?php

/**
 * Table class for the blog article model.
 *
 * @package blog
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +-------------+------------------+------+-----+---------------------+----------------+
 * | Field       | Type             | Null | Key | Default             | Extra          |
 * +-------------+------------------+------+-----+---------------------+----------------+
 * | id          | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 * | blog_id     | int(10) unsigned | NO   |     | NULL                |                |
 * | created     | timestamp        | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified    | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 * | headline    | varchar(50)      | YES  |     | NULL                |                |
 * | subhead     | varchar(50)      | YES  |     | NULL                |                |
 * +-------------+------------------+------+-----+---------------------+----------------+
 */

class Foomy_Blog_Model_Article_Peer extends Zend_Db_Table_Abstract {

  const T_NAME = 'article';

  const F_ID          = 'id';
  const F_BLOG_ID     = 'blog_id';
  const F_CREATED     = 'created';
  const F_MODIFIED    = 'modified';
  const F_HEADLINE    = 'headline';
  const F_SUBHEAD     = 'subhead';

  protected $_name     = self::T_NAME;
  protected $_primary  = self::F_ID;
  protected $_rowClass = 'Foomy_Blog_Model_Article';
  protected $_sequence = true;

  protected $_dependentTables = array(
    'Foomy_Blog_Model_Paragraph_Peer',
    'Foomy_Blog_Model_Article2Tag_Peer',
    'Foomy_Blog_Model_Article2Link_Peer'
  );

  protected $_referenceMap = array(
    'Blog' => array(
      'columns'       => array(self::F_BLOG_ID),
      'refTableClass' => 'Foomy_Blog_Model_Blog_Peer',
      'refColumns'    => array(Foomy_Blog_Model_Blog_Peer::F_ID),
      'onDelete'      => self::CASCADE,
      'onUpdate'      => self::CASCADE
    )
  );

  private static $_instance = null;

  /**
   * Returns an instance of the article table
   *
   * @param void
   * @return Foomy_Blog_Model_Article_Peer
   */
  public static function getInstance() {
    if ( self::$_instance===null ) {
      self::$_instance = new self();
    }
    return(self::$_instance);
  }// getInstance()

  /**
   * Returns a article specified by its database id.
   *
   * @param int $id
   * @return Foomy_Blog_Model_Article
   */
  public static function getById($id) {
    $select = self::getInstance()->select();
    $select->where(self::F_ID.'=?', $id);
    return(self::getInstance()->fetchRow($select));
  }// getById()

  /**
   * Checks whether a article, specified by its database id, exists or not.
   *
   * @param int $artId
   * @return bool
   */
  public static function exists($artId) {
    $dba = self::getInstance()->getAdapter();
    $sql = 'SELECT 1 
              FROM '.self::T_NAME.'
             WHERE id='.$artId;
    $res = $dba->fetchOne($sql);
 
    if ( (int)$res>0 ) {
      return(true);
    }
    return(false);
  }// exists()

  /**
   * Returns the abstract for the article
   *
   * @param int $artId
   * @return string
   */
  public static function getAbstract($artId) {
    $select  = Foomy_Blog_Model_Paragraph_Peer::getInstance()->select();
    $select->where(Foomy_Blog_Model_Paragraph_Peer::F_TYPE.'=?', 'abstract');

    $article = self::getById($artId);
    $paragraphs = $article->findDependentRowset('Foomy_Blog_Model_Paragraph_Peer', null, $select);
    return($paragraphs->getRow(0)->getParagraphText());
  }// getAbstract()

  /**
   * Returns the text paragraphs for the article
   *
   * @param int $artId
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public static function getTextParagraphs($artId) {
    $select = Foomy_Blog_Model_Paragraph_Peer::getInstance()->select();
    $select->where(Foomy_Blog_Model_Paragraph_Peer::F_TYPE.'=?', 'normal');

    $article = self::getById($artId);
    return($article->findDependentRowset('Foomy_Blog_Model_Paragraph_Peer', null, $select));
  }// getTextParagraphs()

  /**
   * Returns all articles of a blog specified by the blog-id.
   *
   * @param int $blog_id
   * @return Zend_Db_Table_Rowset_Abstract | null
   */
  public static function getArticles($blogId) {
    if ( Foomy_Blog_Model_Blog_Peer::exists($blogId) ) {
      $select = self::getInstance()->select();
      $select->where(self::F_BLOG_ID.'=?', $blogId);
      return(self::getInstance()->fetchAll($select));
    }
    return(null);
  }// getArticle()

  /**
   * Returns all tags which are related to a article specified by its id.
   *
   * @param int $artId
   * @return Zend_Db_Table_Rowset
   */
  public static function getTags($artId) {
    $article = self::getById($artId);
    return($article->findManyToManyRowset('Foomy_Model_Tag_Peer', 'Foomy_Blog_Model_Article2Tag_Peer'));
  }// getTags()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  James T. Kirk, Star Trek VI - Das unentdeckte Land
 */
