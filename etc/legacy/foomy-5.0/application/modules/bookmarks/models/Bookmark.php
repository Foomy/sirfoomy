<?php

/**
 * Table row class for the bookmark model. An instance of this
 * class represents a bookmark.
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

class Foomy_Bookmarks_Model_Bookmark extends Zend_Db_Table_Row_Abstract
{
    protected $_primary = Foomy_Bookmarks_Model_Bookmark_Peer::F_ID;

    /**
     * Returns the database id of the quote.
     *
     * @return int
     */
    public function getId()
    {
        return $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_ID};
    }

    /**
     * Returns the creation timestamp in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_CREATED};
    }

    /**
     * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getModified()
    {
        return $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_MODIFIED};
    }

    /**
     * Returns the hyper reference of the bookmark.
     *
     * @return string
     */
    public function getHref()
    {
        return $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_HREF};
    }

    /**
     * Returns the bookmark title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_TITLE};
    }

    /**
     * Returns the bookmark comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_COMMENT};
    }

    /**
     * Returns the picture path for the bookmark thumbnail.
     *
     * @return string | null
     */
    public function getPicture()
    {
        $picture = $this->{Foomy_Bookmarks_Model_Bookmark_Peer::F_PICTURE};
        if (!empty($picture)) {
            return $picture;
        }
        return null;
    }
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
