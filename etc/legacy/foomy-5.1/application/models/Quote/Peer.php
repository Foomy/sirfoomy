<?php

/**
 * Table class for the quote model.
 *
 * @category    Foomy
 * @package     Model
 * @subpackage  Quote_Peer
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * +-----------+---------------------+------+-----+---------------------+----------------+
 * | Field     | Type                | Null | Key | Default             | Extra          |
 * +-----------+---------------------+------+-----+---------------------+----------------+
 * | id        | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created   | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified  | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | deleted   | tinyint(1)          | YES  |     | 0                   |                |
 * | quotetext | text                | YES  |     | NULL                |                |
 * | author    | varchar(255)        | YES  |     | NULL                |                |
 * | extra     | varchar(255)        | YES  |     | NULL                |                |
 * +-----------+---------------------+------+-----+---------------------+----------------+
 */

/**
 * Requirement: RowClass.
 *
 * @see Model_Quote
 */
require_once APPLICATION_PATH . '/models/Quote.php';

class Model_Quote_Peer extends Zend_Db_Table_Abstract
{
    const DEBUG = false;

    const T_NAME = 'quote';
  
    const F_ID        = 'id';
    const F_CREATED   = 'created';
    const F_MODIFIED  = 'modified';
    const F_QUOTETEXT = 'quotetext';
    const F_AUTHOR    = 'author';
    const F_EXTRA     = 'extra';

    protected $_name     = self::T_NAME;
    protected $_primary  = self::F_ID;
    protected $_rowClass = 'Model_Quote';
    protected $_sequence = true;

    protected static $_instance = null;
  
    /**
     * Returns an instance of the quote table.
     *
     * @param void
     * @return Model_Quote_Peer
     */
    public static function getInstance()
    {
        if (self::$_instance===null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }// getInstance()

    /**
     * Returns a quote identified by its database id.
     *
     * @param string $id
     * @return Model_Quote
     */
    public static function getById($id)
    {
        $select = self::getInstance()->select();
        $select->where(self::F_ID.'=?', $id);

        return self::getInstance()->fetchRow($select);
    }// getById()

    /**
     * Returns a random quote.
     *
     * @param void
     * @return Model_Quote
     */
    public static function getRandom()
    {
        $select = self::getInstance()->select();
        $select->order(array('RAND()'))
               ->limit(1);

        return self::getInstance()->fetchRow($select);
    }//getRandom()

    /**
     * Returns an array of quote objects.
     *
     * @param void
     * @return Zend_Db_Table_Rowset_Abstract
     *
     * @todo Prepare the method for use with Zend_Paginator
     */
    public static function getList()
    {
        $select = self::getInstance()->select();

        return self::getInstance()->fetchAll($select);
    }// getList()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
