<?php

/**
 * Table class for the user model.
 *
 * @package default
 * @subpackage model
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 *
 * +----------+------------------+------+-----+---------------------+----------------+
 * | Field    | Type             | Null | Key | Default             | Extra          |
 * +----------+------------------+------+-----+---------------------+----------------+
 * | id       | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
 * | role_id  | int(10) unsigned | YES  |     | NULL                |                |
 * | created  | timestamp        | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
 * | deleted  | tinyint(1)       | NO   |     | 0                   |                |
 * | nickname | varchar(30)      | YES  |     | NULL                |                |
 * | email    | varchar(255)     | NO   | UNI | NULL                |                |
 * | password | varchar(50)      | YES  |     | NULL                |                |
 * | locked   | tinyint(1)       | NO   |     | 0                   |                |
 * +----------+------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_User_Peer extends Zend_Db_Table_Abstract
{
    const DEBUG = false;

    const T_NAME = 'user';

    const F_ID       = 'id';
    const F_ROLE_ID  = 'role_id';
    const F_CREATED  = 'created';
    const F_MODIFIED = 'modified';
    const F_DELETED  = 'deleted';
    const F_NICKNAME = 'nickname';
    const F_EMAIL    = 'email';
    const F_PASSWORD = 'password';
    const F_LOCKED   = 'locked';

    protected $_name     = self::T_NAME;
    protected $_primary  = self::F_ID;
    protected $_rowClass = 'Foomy_Model_User';
    protected $_sequence = true;

    protected $_referenceMap = array(
        'Role' => array(
            'columns'       => array(self::F_ROLE_ID),
            'refTableClass' => 'Foomy_Model_Role_Peer',
            'refColumns'    => array(Foomy_Model_Role_Peer::F_ID),
            'onDelete'      => self::CASCADE,
            'onUpdate'      => self::CASCADE
        )
    );

    protected static $_instance = null;

    /**
     * Returns an instance of the user table.
     *
     * @param void
     * @return Foomy_Model_User_Peer
     */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }// getInstance()

    /**
     * Returns a user object specified by its database id.
     *
     * @param int $id
     * @return Foomy_Model_User
     */
    public static function getById($id)
    {
        $select = self::getInstance()->select();
        $select->where(self::F_ID.'=?', $id);

        return self::getInstance()->fetchRow($select);
    }// getById()

    /**
     * Returns a user object specified by email address of the user.
     *
     * @param int $id
     * @return Foomy_Model_User
     */
    public static function getByEmail($email)
    {
        $select = self::getInstance()->select();
        $select->where(self::F_EMAIL.'=?', $email);

        return self::getInstance()->fetchRow($select);
    }// getByEmail()

    /**
     * Checks whether a user exists in the database.
     *
     * @param string $email
     * @return bool
     */
    public static function exists($email)
    {
        $dba = self::getInstance()->getAdapter();
        $sql = 'SELECT 1
                FROM '.self::T_NAME.'
                WHERE email='.$email;
        $res = $dba->fetchOne($sql);

        if ((int)$res > 0) {
            return true;
        }
        return false;
    }// exists()

    /**
     * Returns a list of all registered users.
     *
     * @param bool $deleted   Optional! Default: FALSE
     *                        Set TRUE to show also deleted users.
     * @param bool $locked    Optional! Default: FALSE
     *                        Set TRUE to show also locked users.
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public static function getList($deleted=false, $locked=false)
    {
        $select = self::getInstance()->select();
        if (! $deleted) {
            $select->where(self::F_DELETED.'=?', '0');
        }
        if (! $locked) {
            $select->where(self::F_LOCKED.'=?', '0');
        }

        return self::getInstance()->fetchAll($select);
    }// getList()

    /**
     * Returns the roles the user belongs to.
     *
     * @return Zend_Db_Table_Rowset
     */
    public static function getRole($id)
    {
        $user = self::getById($id);
        return $user->findParentRow('Foomy_Model_Role_Peer');
    }// getRoles()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
