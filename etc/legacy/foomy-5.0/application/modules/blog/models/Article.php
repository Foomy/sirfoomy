<?php

/**
 * Table row class for the blog article. An instance of this
 * class represents an article of the blog.
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

class Foomy_Blog_Model_Article extends Zend_Db_Table_Row_Abstract {

  protected $_primary = Foomy_Blog_Model_Article_Peer::F_ID;

  protected $_paragraphs = array();

  /**
   * Returns the database id of the blog entry.
   *
   * @return int
   */
  public function getId() {
    return($this->{Foomy_Blog_Model_Article_Peer::F_ID});
  }// getId()

  /**
   * Returns the database id of the blog, which the article depends on.
   *
   * return int
   */
  public function getBlogId() {
    return($this->{Foomy_Blog_Model_Article_Peer::F_BLOG_ID});
  }// getBlogId()

  /**
   * Sets the blog id for the article.
   *
   * @param int $blogId
   * @return Foomy_Blog_Model_Article
   */
  public function setBlogId($blogId) {
    if ( (int)$blogId>0 ) {
      $this->{Foomy_Blog_Model_Article_Peer::F_BLOG_ID} = $blogId;
    } else {
      throw new Exception('Invalid blog id committed.');
    }
    return($this);
  }// setBlogId() 

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Blog_Model_Article_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Blog_Model_Article_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the headline for the article.
   *
   * @retrun string
   */
  public function getHeadline() {
    return($this->{Foomy_Blog_Model_Article_Peer::F_HEADLINE});
  }// getHeadline()

  /**
   * Set the article's headline to the committed value.
   *
   * @param string $headline
   * @return Foomy_Blog_Model_Article
   */
  public function setHeadline($headline) {
    if ( ! empty($headline) ) {
      $this->{Foomy_Blog_Model_Article_Peer::F_HEADLINE} = $headline;
    }
    return($this);
  }// setHeadline()

  /**
   * Returns the subhead for the article.
   *
   * @return string
   */
  public function getSubhead() {
    return($this->{Foomy_Blog_Model_Article_Peer::F_SUBHEAD});
  }// getSubhead()

  /**
   * Sets the article's subhead to the committed value.
   *
   * @param string $subhead
   * @return Foomy_Blog_Model_Article
   */
  public function setSubhead($subhead) {
    if ( ! empty($subhead) ) {
      $this->{Foomy_Blog_Model_Article_Peer::F_SUBHEAD} = $subhead;
    }
    return($this);
  }// setSubhead()

  /**
   * Returns the abstract for the article.
   *
   * @return string
   */
  public function getAbstract() {
    return(Foomy_Blog_Model_Article_Peer::getAbstract($this->{Foomy_Blog_Model_Article_Peer::F_ID}));
  }// getAbstract();

  /**
   * Returns the article text.
   *
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public function getTextParagraphs() {
    return(Foomy_Blog_Model_Article_Peer::getTextParagraphs($this->{Foomy_Blog_Model_Article_Peer::F_ID}));
  }// getArticleText()

  /**
   * Returns all tags which are related to the article.
   *
   * @return Zend_Db_Table_Rowset
   */
  public function getTags() {
    return(Foomy_Blog_Model_Article_Peer::getTags($this->{Foomy_Blog_Model_Article_Peer::F_ID})); 
  }// getTags()

  /**
   * Adds a new paragraph to the article.
   *
   * @param string $paragraphText
   * @param string $type  Optional! Default: 'normal'
   * @return Foomy_Blog_Model_Article
   */
  public function addParagraph($paragraphText, $type='normal') {
    if ( ! empty($paragraphText) ) {
      $paragraphTbl = new Foomy_Blog_Model_Paragraph_Peer();
      $paragraph = $paragraphTbl->createRow();
      $paragraph->setParagraphText($paragraphText)
                ->setType($type);
      $this->_paragraphs[] = $paragraph;
    }
    return($this);
  }// addParagraph()

  /**
   * Adds a abstract to the article.
   *
   * @param string $abstractText
   * @return Foomy_Blog_Model_Article
   */
  public function addAbstract($abstract) {
    return($this->addParagraph($abstract, 'abstract'));
  }// addAbstract()

  public function save() {
    $articleId = parent::save();

    foreach ($this->_paragraphs as $paragraph) {
      $paragraph->setArticleId($articleId);
      $paragraph->save();
    }
    
    return($articleId);
  }// save()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  James T. Kirk, Star Trek VI - Das unendeckte Land
 */
