<?php

/**
 * Class for the bookmark to tag intersection table
 *
 * @category    Bookmarks
 * @Package     Model
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * +-------------+------------------+------+-----+---------+----------------+
 * | Field       | Type             | Null | Key | Default | Extra          |
 * +-------------+------------------+------+-----+---------+----------------+
 * | id          | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
 * | bookmark_id | int(10) unsigned | NO   |     | NULL    |                |
 * | tag_id      | int(10) unsigned | NO   |     | NULL    |                |
 * +-------------+------------------+------+-----+---------+----------------+
 */

class Foomy_Bookmarks_Model_Bookmark2Tag_Peer extends Zend_Db_Table_Abstract
{
    const DEBUG = false;

    const T_NAME = 'bookmark2tag';

    const F_ID          = 'id';
    const F_BOOKMARK_ID = 'bookmark_id';
    const F_TAG_ID      = 'tag_id';

    protected $_name     = self::T_NAME;
    protected $_primary  = self::F_ID;
    protected $_sequence = true;

    protected $_referenceMap = array(
        'Bookmark' => array(
            'columns'       => array(self::F_BOOKMARK_ID),
            'refTableClass' => 'Foomy_Model_Bookmark_Peer',
            'refColums'     => array(Foomy_Model_Bookmark_Peer::F_ID),
            'onDelete'      => self::CASCADE,
            'onUpdate'      => self::CASCADE
        ),
        'Tag' => array(
            'columns'        => array(self::F_TAG_ID),
            'refTableClass' => 'Foomy_Model_Tag_Peer',
            'refColumns'    => array(Foomy_Blog_Model_Tag_Peer::F_ID),
            'onDelete'      => self::CASCADE,
            'onUpdate'      => self::CASCADE
        )
    );

    protected static $instance = null;

    /**
     * Returns an instance of the blog tag/entry intersection table.
     *
     * @param void
     * @return Foomy_Blog_Model_Tag_Peer
     */
    public static function getInstance()
    {
        if ( self::$instance===null ) {
            self::$instance = new self();
        }

        return self::$instance;
    }// getInstance()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
