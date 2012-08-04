<?php

/**
 * Table row class for the article paragraph.
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

class Foomy_Blog_Model_Paragraph extends Zend_Db_Table_Row_Abstract {

  protected $_primary = Foomy_Blog_Model_Paragraph_Peer::F_ID;

  protected $_types = array(
    'abstract',
    'normal'
  );

  /**
   * Returns the database id.
   *
   * @return int
   */
  public function getId() {
    return($this->{Foomy_Blog_Model_Paragraph_Peer::F_ID});
  }// getId()

  /**
   * Returns the database id of the article the paragraph belongs to.
   *
   * @return int
   */
  public function getArticleId() {
    return($this->{Foomy_Blog_Model_Pragraph_Peer::F_ARTICLE_ID});
  }// getArticleId()

  /**
   * Sets the article id for the paragraph.
   *
   * @param int $articleId
   * @return Foomy_Blog_Model_Paragraph
   */
  public function setArticleId($articleId) {
    if ( (int)$articleId>0 ) {
      $this->{Foomy_Blog_Model_Paragraph_Peer::F_ARTICLE_ID} = $articleId;
    } else {
      throw new Exception('Invalid article id committed.');
    }
    return($this);
  }

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Blog_Model_Paragraph_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Blog_Model_Paragraph_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the paragraph type.
   *
   * @return string
   */
  public function getType() {
    return($this->{Foomy_Blog_Model_Paragraph_Peer::F_TYPE});
  }// getType()

  /**
   * Sets the paragraph type to the committed value.
   *
   * @param string $type
   * @return Foomy_Blog_Model_Paragrah
   */
  public function setType($type) {
    if ( in_array($type, $this->_types) ) {
      $this->{Foomy_Blog_Model_Paragraph_Peer::F_TYPE} = $type;
    } else {
      throw new Exception('Invalid pragraph type committed.');
    }
    return($this);
  }// setType()

  /**
   * Returns the paragraph text.
   *
   * @return string
   */
  public function getParagraphText() {
    return($this->{Foomy_Blog_Model_Paragraph_Peer::F_PARAGRAPHTEXT});
  }// getParagraphText() 

  /**
   * Sets the paragraph's text.
   *
   * @param string $paragraphText
   * @return Foomy_Blog_Model_Paragraph
   */
  public function setParagraphText($paragraphText) {
    if ( ! empty($paragraphText) ) {
      $this->{Foomy_Blog_Model_Paragraph_Peer::F_PARAGRAPHTEXT} = $paragraphText;
    } else {
      throw new Exception('Paragraph text mustn\'t be empty.');
    }
    return($this);
  }// setParagraphText()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  James T. Kirk, Star Trek VI - Das unendeckte Land
 */
