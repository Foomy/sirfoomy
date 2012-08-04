<?php

/**
 * Table row class for the user model.
 * An instance of this class represent an user.
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
 * | deleted  | tinyint(1)          | NO   |     | 0                   |                |
 * | nickname | varchar(30)         | YES  |     | NULL                |                |
 * | email    | varchar(255)        | NO   | UNI | NULL                |                |
 * | password | varchar(50)         | YES  |     | NULL                |                |
 * | locked   | tinyint(1)          | NO   |     | 0                   |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 */

class Foomy_Model_User extends Zend_Db_Table_Row_Abstract
{
    protected $_primary = Foomy_Model_User_Peer::F_ID;

    /**
     * Returns the user id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->{Foomy_Model_User_Peer::F_ID};
    }// getId()

    /**
     * Returns the creation timestamp in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->{Foomy_Model_User_Peer::F_CREATED};
    }// getCreated()

    /**
     * Returns the timestamp of the last modification
     * in the format "Y.m.d H:i:s".
     *
     * @return string
     */
    public function getModified()
    {
        return $this->{Foomy_Model_User_Peer::F_MODIFIED};
    }// getModified()

    /**
     * Returns whether the user is marked as deleted or not.
     *
     * @return bool
     */
    public function isDeleted()
    {
        if ($this->{Foomy_Model_User_Peer::F_DELETED} > 0) {
            return true;
        }
        return false;
    }// isDeleted()

    /**
     * Returns the users nickname.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->{Foomy_Model_User_Peer::F_NICKNAME};
    }// getNickname()

    /**
     * Sets the user's nickname to the committed value.
     *
     * @param string $nickname
     * @return Foomy_Model_User
     */
    public function setNickname($nickname)
    {
        if (isset($nickname) && (! empty($nickname))) {
            $this->{Foomy_Model_User_Peer::F_NICKNAME} = $nickname;
        }

        return $this;
    }// setNickame()

    /**
     * Returns the user's email address. 
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->{Foomy_Model_User_Peer::F_EMAIL};
    }// getEmail()

    /**
     * Sets the user's email address to the committed value.
     *
     * @param string $email
     * @return Foomy_Model_User
     */
    public function setEmail($email)
    {
        if (isset($email) && (! empty($email))) {
            $this->{Foomy_Model_User_Peer::F_EMAIL} = $email;
        }

        return $this;
    }// setEmail()

    /**
     * Returns the user's password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->{Foomy_Model_User_Peer::F_PASSWORD};
    }//getPassword()

    /**
     * Sets the user's password to the committed value.
     *
     * @param string $password
     * @return Foomy_Model_User
     */
    public function setPassword($password)
    {
        if (isset($password) && (! empty($password))) {
            $this->{Foomy_Model_User_Peer::F_PASSWORD} = $password;
        }

        return $this;
    }//setPassword()

    /**
     * Returns whether the user is locked or not.
     *
     * @return bool
     */
    public function isLocked()
    {
        if ($this->{Foomy_Model_User_Peer::F_LOCKED}>0) {
            return true;
        }

        return false;
    }// isLocked();

    /**
     * Locks the user's account.
     *
     * @return Foomy_Model_User
     */
    public function lock()
    {
        $this->{Foomy_Model_User_Peer::F_LOCKED} = true;
        $this->save();
    
        return $this;
    }// lock()

    /**
     * Unlocks the user's account.
     *
     * @return Foomy_Model_User
     */
    public function unlock()
    {
        $this->{Foomy_Model_User_Peer::F_LOCKED} = false;
        $this->save();

        return $this;
    }// unlock()

    /**
     * Compares the committed password with the users password.
     *
     * @param string password
     * @return bool
     */
    public function checkPassword($password)
    {
        return ($this->password === $password);
    }// checkPassword()

    /**
     * Returns the role the user belongs to.
     *
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getRole()
    {
        return Foomy_Model_User_Peer::getRole($this->{Foomy_Model_User_Peer::F_ID});
    }// getRole()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
