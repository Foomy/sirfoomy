<?php
/** foomy.net
 *    classes/FoomyUser.class.php
 *  
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    01.08.2008 - file created
 *
 *  (c) 2008 by Sascha Schneider
 * 
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | Field    | Type                | Null | Key | Default             | Extra          |
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | id       | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created  | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | deleted  | tinyint(1)          | YES  |     | 0                   |                |
 * | nickname | varchar(30)         | YES  |     | NULL                |                |
 * | email    | varchar(255)        | YES  |     | NULL                |                |
 * | password | varchar(50)         | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 */
 
class FoomyUser extends User {

  private
    $groups;

  public function __construct($id) {
    parent::__construct($id);
  }// Konstruktor
    
  public static function GetById($id) {
    try {
      $ret = new FoomyUser($id);
    } catch (Exception $e) {
      panic($e);
    }
    return($ret);
  }// GetById()
    
  public static function GetByEmail($email) {
    $dbo = Base::GetDbInstance();
    $sql = 'SELECT id FROM user WHERE email=:1';
    try {
      $dbret = $dbo->prepare($sql)->execute($email)->fetch_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }
      
    if ( is_array($dbret) ) {
      return(self::GetById($dbret['id']));
    }
    return(false);
  }// GetByEmail()


  /**
   * getters
   */
  public function GetGroups() {
  	return($this->groups);
  }// GetUserGroups()


  /**
   * setters
   */

  /**
   * public misc methods
   */
  public static function Login($email, $password) {
    $dbo = Base::GetDbInstance(); 
    $sql = 'SELECT password
              FROM user
             WHERE email=:1';
    try {
      $dbret = $dbo->prepare($sql)->execute($email)->fetch_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }

    if ( is_array($dbret) ) {
      if ( $password==$dbret['password'] ) {
        $_SESSION['user'] = self::GetByEmail($email);
        return(true);
      }
    }
    return(false);
  }// Login()

  public function Logout() {
    /** void User::Logout()
     * Removes the user instance from the session
     * and redirect the user to the homepage.
     */
    unset($_SESSION['request']);
    parent::Logout();
  }// Logout()

  public static function RootOnly() {
  	if ( ! self::IsRoot() ) {
      $_SESSION['request'] = $_SERVER['SCRIPT_NAME'];
      header('Location: /user/login.php');
      exit(0);
    }
  }// RootOnly()

  public static function AdminsOnly() {
    if ( ! self::IsAdmin() ) {
      $_SESSION['request'] = $_SERVER['SCRIPT_NAME'];
      header('Location: /user/login.php');
      exit(0);
    }
  }// AdminsOnly()
  
  public static function UsersOnly() {
    if ( ! self::LoggedIn() ) {
      $_SESSION['request'] = $_SERVER['SCRIPT_NAME'];
      header('Location: /user/login.php');
      exit(0);
    }
  }// UsersOnly()
  
  public static function IsRoot() {
    if ( self::LoggedIn() && self::InGroup('root') ) {
      return(true);
    }
    return(false);
  }// IsRoot()
  
  public static function IsAdmin() {
  	if ( self::LoggedIn() ) {
  		if ( self::InGroup('admin') || self::InGroup('root') ) {
  			return(true);
  		}
  	}
    return(false);
  }// IsAdmin()
  
  public static function InGroup($groupname, $user_id=0) {
    foreach ($_SESSION['user']->groups as $group) {
      if ( $groupname==$group ) {
        return(true);
      }
    }
    return(false);
  }// InGroup()
  
  /**
   * private misc methods
   */
  protected function ReadData() {
    $sql = 'SELECT id, created, modified, deleted,
                   nickname, email, password
              FROM user
             WHERE id=:1';
    try {
      $dbret = $this->dbh->prepare($sql)->execute($this->id)->fetch_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }

    if ( is_array($dbret) && (! empty($dbret)) ) {
      $this->created  = $dbret['created'];
      $this->modified = $dbret['modified'];
      $this->nickname = $dbret['nickname'];
      $this->email    = $dbret['email'];
      $this->password = $dbret['password'];
      $this->groups   = $this->ReadUserGroups($this->id);
        
      return(true);
    }
    return(false);
  }// ReadData()
    
  private function ReadUserGroups($user_id) {
    if ( (int)$user_id>0 ) {
      $sql = 'SELECT ug.name
                FROM usergroup ug
           LEFT JOIN user2usergroup u2ug ON (u2ug.usergroup_id=ug.id)
               WHERE u2ug.user_id=:1';
      try {
        $dbret = $this->dbh->prepare($sql)->execute($user_id)->fetchall_assoc();
      } catch (MysqlException $e) {
        panic($e);
      }
        
      if ( is_array($dbret) && (! empty($dbret)) ) {
        foreach ($dbret as $dr) {
          $ret[] = $dr['name'];
        }
        return($ret);
      }
    }
    return(false);
  }// ReadUserGoup()
}
?>
