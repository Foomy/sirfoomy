<?php

/**
 * Table class for the tag model.
 *
 * Tags are actually used for
 *    * blog articles
 *    * bookmarks
 *
 * @category    Foomy
 * @package     Foomy_Model
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | Field    | Type                | Null | Key | Default             | Extra          |
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | id       | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created  | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | tagname  | varchar(50)         | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_Tag_Peer extends Zend_Db_Table_Abstract
{
    const DEBUG = false;

    const T_NAME = 'tag';

    const F_ID       = 'id';
    const F_CREATED  = 'created';
    const F_MODIFIED = 'modified';
    const F_TAGNAME  = 'tagname';

    protected $_name     = self::T_NAME;
    protected $_primary  = self::F_ID;
    protected $_rowClass = 'Foomy_Model_Tag';
    protected $_sequence = true;

    protected $_dependentTables = array(
        'Foomy_Blog_Model_Article2Tag_Peer',
        'Foomy_Bookmarks_Model_Bookmark2Tag_Peer',
    );

    protected static $instance = null;

    /**
     * Returns an instance of the tag table.
     *
     * @param void
     * @return Foomy_Model_Tag_Peer
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }// getInstance()

    /**
     * Returns a blogtag specified by its database id.
     *
     * @param int $id
     * @return Foomy_Model_Tag
     */
    public static function getById($id)
    {
        $select = self::getInstance()->select();
        $select->where(self::F_ID.'=?', $id);

        return self::getInstance()->fetchRow($select);
    }// getById()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
