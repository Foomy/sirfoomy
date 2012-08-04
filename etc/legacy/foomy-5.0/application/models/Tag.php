<?php

/**
 * Table row class for the tag model. An instance of this class
 * represents a tag.
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

class Foomy_Model_Tag extends Zend_Db_Table_Row_Abstract
{
    protected $_primary = Foomy_Model_Tag_Peer::F_ID;

    /**
     * Returns the database id of the tag.
     *
     * @return int
     */
    public function getId()
    {
        return $this->{Foomy_Model_Tag_Peer::F_ID};
    }// getId()

    /**
     * Returns the creation timestamp in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->{Foomy_Model_Tag_Peer::F_CREATED};
    }// getCreated()

    /**
     * Returns the timestamp of the last modification in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getModified()
    {
        return $this->{Foomy_Model_Tag_Peer::F_MODIFIED};
    }// getModified()

    /**
     * Returns the name of the tag.
     *
     * @return string
     */
    public function getName()
    {
        return $this->{Foomy_Model_Tag_Peer::F_TAGNAME};
    }// getName()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
