<?php

/**
 * Table row class for the blog model. An instance of this class
 * represents an entire blog.
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
 * | deleted  | tinyint(1)          | YES  |     | 0                   |                |
 * | title    | varchar(30)         | YES  |     | NULL                |                |
 * | subtitle | varchar(30)         | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 */

class Foomy_Blog_Model_Blog extends Zend_Db_Table_Row_Abstract {

  protected $_primary = Foomy_Blog_Model_Blog_Peer::F_ID;

  /**
   * Returns the database id of the blog.
   *
   * @return int
   */
  public function getId() {
    return($this->{Foomy_Blog_Model_Blog_Peer::F_ID});
  }// getId()

  /**
   * Returns the creation timestamp in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getCreated() {
    return($this->{Foomy_Blog_Model_Blog_Peer::F_CREATED});
  }// getCreated()

  /**
   * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
   *
   * @return string
   */
  public function getModified() {
    return($this->{Foomy_Blog_Model_Blog_Peer::F_MODIFIED});
  }// getModified()

  /**
   * Returns the blog title.
   *
   * @return string
   */
  public function getTitle() {
    return($this->{Foomy_Blog_Model_Blog_Peer::F_TITLE});
  }// getTitle()

  /**
   * Returns the subtitle of the blog.
   *
   * @return string
   */
  public function getSubTitle() {
    return($this->{Foomy_Blog_Model_Blog_Peer::F_SUBTITLE});
  }// getSubTitle()

  /**
   * Returns all articles of the blog.
   *
   * @param void
   * @return Zend_Db_Table_Rowset_Abstract
   */
  public function getArticles() {
    return(Foomy_Blog_Model_Article_Peer::getArticles($this->{Foomy_Blog_Model_Blog_Peer::F_ID}));
  }// getArticles()

  /**
   * Returns a blog article specified by its database id.
   *
   * @param int $artId
   * @return Foomy_Blog_Model_Article
   */
  public function getArticle($artId) {
    return(Foomy_Blog_Model_Article_Peer::getById($artId));
  }// getArticle()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
