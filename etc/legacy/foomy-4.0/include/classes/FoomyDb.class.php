<?php

class DbMysqlTest extends DB_Mysql {
  protected $user;
  protected $pass;
  protected $dbhost;
  protected $dbname;

  private static $instance = null;

  public function __construct() {
    $c = new MyCrypt();
    $this->user = $c->encrypt('foomy_web');
    $this->pass = $c->encrypt('MVemjSu9P.');
    $this->dbhost = $c->encrypt('localhost');
    $this->dbname = $c->encrypt('foomy');
  }// Konstruktor

  public static function GetInstance() {
    if ( self::$instance == null ) {
      self::$instance = new self;
    }
    return(self::$instance);
  }// GetInstance()
}// class DB_Mysql_Test


class DbMysqlTestDebug extends DbMysqlTest {
  protected $elapsedTime;

  public function Execute($query) {
    // set timer;
    parent::execute($query);
    // end timer;
  }// Execute()

/*
  public function GetElapsedTime() {
    return($this->$elapsedTime);
  }// GetElapsedTime()
*/
}// class DB_Mysql_Test_Debug


class DbMysqlProd extends DB_Mysql {
  protected $user;
  protected $pass;
  protected $dbhost;
  protected $dbname;

  private static $instance = null;

  public function __construct() {
    $c = new MyCrypt();
    $this->user = $c->encrypt('foomy_web');
    $this->pass = $c->encrypt('MVemjSu9P.');
    $this->dbhost = $c->encrypt('localhost');
    $this->dbname = $c->encrypt('foomy');
  }// Konstruktor

  public static function GetInstance() {
    if ( self::$instance == null ) {
      self::$instance = new self;
    }
    return(self::$instance);
  }// GetInstance()
}// class DB_Mysql_Prod

?>