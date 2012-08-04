<?php

/**
 * Table class for the bookmark.
 *
 * @category    Bookmarks
 * @package     Model
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * +----------+------------------+------+-----+---------------------+----------------+
 * | Field    | Type             | Null | Key | Default             | Extra          |
 * +----------+------------------+------+-----+---------------------+----------------+
 * | id       | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created  | timestamp        | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 * | href     | varchar(4096)    | YES  |     | NULL                |                |
 * | title    | varchar(255)     | YES  |     | NULL                |                |
 * | comment  | text             | YES  |     | NULL                |                |
 * +----------+------------------+------+-----+---------------------+----------------+
 */

class Foomy_Bookmarks_Model_Bookmark_Peer extends Zend_Db_Table_Abstract
{
    const DEBUG = true;

    const T_NAME = 'bookmark';

    const F_ID       = 'id';
    const F_CREATED  = 'created';
    const F_MODIFIED = 'modified';
    const F_HREF     = 'href';
    const F_TITLE    = 'title';
    const F_COMMENT  = 'comment';
    const F_PICTURE  = 'picture';

    protected $_name     = self::T_NAME;
    protected $_primary  = self::F_ID;
    protected $_rowClass = 'Foomy_Bookmarks_Model_Bookmark';
    protected $_sequence = true;

    protected static $instance = null;

    /**
     * Returns an instance of the bookmark table.
     *
     * @param void
     * @return Foomy_Bookmarks_Model_Bookmark_Peer
     */
    public static function getInstance()
    {
        if ( self::$instance===null ) {
            self::$instance = new self();
        }

        return(self::$instance);
    }// getInstance()

    /**
     * Returns a bookmark identified by its database id.
     *
     * @param string $id
     * @return Foomy_Bookmarks_Model_Bookmark
     */
    public static function getById($id)
    {
        $select = self::getInstance()->select();
        $select->where(self::F_ID.'=?', $id);

        return self::getInstance()->fetchRow($select);
    }// getById()

    /**
     * Returns a list of all bookmarks stored in the database.
     *
     * @param void
     * @return Zend_Db_Table_Rowset | array()
     */
    public static function getList()
    {
        $select = self::getInstance()->select();
        $result = self::getInstance()->fetchAll($select);

        if ($result->count() > 0) {
            return $result;
        }
        return array();
    }// getList()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */

