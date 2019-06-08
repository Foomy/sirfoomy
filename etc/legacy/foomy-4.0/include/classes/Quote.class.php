<?php
/** foomy.net
 *    classes/Quote.class.php
 *
 * @author Sascha Schneider <foomy.code@arcor.de>
 * @copyright Copyright (c) 2008 by Sascha Schneider
 *
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | Field    | Type                | Null | Key | Default             | Extra          |
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | id       | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created  | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | deleted  | tinyint(1)          | YES  |     | 0                   |                |
 * | text     | text                | YES  |     | NULL                |                |
 * | author   | varchar(255)        | YES  |     | NULL                |                |
 * | extra    | varchar(255)        | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 */
 
class Quote extends Base {

  private
    $id,

    $text,
    $author,
    $extra,

    $quotelist;

  public function __construct($id=0) {
    parent::__construct();
    
    $this->text   = 'Aus Technischen Gründen gibt es z.Zt. keine Zitate. Sorry! ;-(';
    $this->author = 'Foomy';
    $this->extra  = 'Webmaster';

    $this->id = (int)$id;
    if ( $this->id>0 && (! $this->ReadData()) ) {
      throw new Exception('Ungültige Id!');
    }
  }//Konstruktor

  /** 
   * Gibt ein bestimmtes Zitat anhand der id zurück.
   *
   * @param int $id  Die Id des Zitats.
   * @return object  Zitat als Objekt.
   */
  public static function GetById($id) {
    try {
    	$ret = new Quote($id);
    } catch (Exception $e) {
    	panic($e);
    }
    return($ret);
  }// GetQuoteById()

  /**
   * Gibt ein zufälliges Zitat zurück.
   *
   * @param void
   * @return object  Zufallszitat als Objekt
   */
  public static function GetRandom() {
    $dbo = self::GetDbInstance();
    
    $sql = 'SELECT id
              FROM quote
          ORDER BY RAND()
             LIMIT 1';
    try {
      $dbret = $dbo->Prepare($sql)->Execute()->fetch_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }
    
    if ( is_array($dbret) ) {
      return(self::GetById($dbret['id']));
    }
    return(new Quote());
  }// GetRandom();

  /**
   * Gibt alle Quotes als Array zurück.
   *
   * @param bool $forcecache  Optional! Lesen aus der Db erzwingen. 
   */
  public function GetQuoteList($forcecache=false) {
    if ( $forcecache || (! $this->HasValue($this->quotelist)) ) {
      $sql = 'SELECT id FROM quote';
      try {
        $dbret = $this->dbh->prepare($sql)->execute()->fetchall_assoc();
      } catch (MysqlException $e) {
        panic($e);
      }
    
      if ( is_array($dbret) ) {
        foreach ( $dbret as $dr ) {
          $this->quotelist[] = new Quote($dr['id']);
        }
      }
    }
    return($this->quotelist);
  }// GetQuoteList()


  /**
   * Gibt die Id des Zitats zurück
   *
   * @param void
   * @return int  Die Id des Zitats.
   */
  public function Id() {
    return($this->id);
  }// Id()

  /**
   * Gibt den Zitattext zurück oder ändert ihn.
   *
   * @param string $text  Optional! Der ggf. neue Zitattext.
   * @return string       Der aktuelle Zitattext.
   */
  public function Text($text='') {
    if ( $this->HasValue($text) ) {
    	$this->text = $text;
      if ( (int)$this->id>0 ) {
      	$sql = 'UPDATE quote SET text=:2 WHERE id=:1';
        try {
        	$this->dbh->prepare($sql)->execute($this->id, $text);
        } catch (MysqlException $e) {
        	panic($e);
        }
      }
    }
    return($this->text);
  }// Text()

  /**
   * Gibt den Autor des Zitats zurück oder ändert ihn.
   *
   * @param string $author  Optional! Der ggf. neue Autor.
   * @return string         Der aktuelle Autor.
   */
  public function Author($author='') {
    if ( $this->HasValue($author) ) {
    	$this->author = $author;
      if ( (int)$this->id>0 ) {
      	$sql = 'UPDATE quote SET text=:2 WHERE id=:1';
        try {
        	$this->dbh->prepare($sql)->execute($this->id, $author);
        } catch (MysqlException $e) {
        	panic($e);
        }
      }
    }
    return($this->author);
  }// Author()

  /**
   * Gibt die Zusatzinformationen des Zitats zurück oder ändert sie.
   *
   * @param string $extra  Optional! Die ggf. neuen Zusatzinfos.
   * @return string        Die aktuellen Zusatzinfos.
   */
  public function Extra($extra='') {
    return($this->extra);
  }// Extra()

  /**
   * Speichert ein neues Zitat in der Datenbank.
   *  
   * @param void
   * @return bool  Im Erfolgsfall TRUE.
   */
  public function Save() {
    $sql = 'INSERT INTO quote (text, author, extra)
                 VALUES (:1, :2, :3)';
    try {
      $this->dbh->prepare($sql)->execute($this->text, $this->author, $this->extra);
    } catch (MysqlException $e) {
      panic($e);
    }
    return(true);
  }//Save()

  /**
   * Löscht das Zitat in der Datenbank.
   *
   * @param void
   * @return bool  Im Erfolgsfall TRUE.
   */
  public function Delete() {
  	$sql = 'DELETE FROM quote WHERE id=:1';
    try {
    	$this->dbh->prepare($sql)->execute($this->id);
    } catch (MysqlException $e) {
    	panic($e);
    }
    return(true);
  }// Delete()

  /**
   * Prüft ob es das Zitat bereits in der Db existiert.
   *
   * @param int $id  Die Id des Zitats.
   * @return bool  TRUE falls in Db existent.
   */
  private function ExistsInDb($id) {
    if ( (int)$id>0 ) {
      $sql = 'SELECT count(*) AS anzahl
                FROM quote
               WHERE id=:1';
      try {
        $dbret = $this->dbh->prepare($sql)->execute($id)->fetch_assoc();
      } catch (MysqlException $e) {
      	panic($e);
      }
      
      if ( is_array($dbret) && $dbret['anzahl']>0 ) {
      	return(true);
      }
    }
    return(false);
  }// ExistsInDb()

  /**
   * Liest die Daten des Zitats aus der Db für die Objektinitialisierung.
   *
   * @param void
   * @return bool  Im Erfolgsfall TRUE.
   */
  protected function ReadData() {
    $sql = 'SELECT id, created, modified,
                   quotetext, author, extra
              FROM quote
             WHERE id=:1';
    try {
    	$dbret = $this->dbh->prepare($sql)->Execute($this->id)->fetch_assoc();
    } catch (MysqlException $e) {
    	panic($e);
    }
    
    if ( is_array($dbret) && (! empty($dbret)) ) {
      $this->created  = $dbret['created'];
      $this->modified = $dbret['modified'];
      $this->text     = $dbret['quotetext'];
      $this->author   = $dbret['author'];
      $this->extra    = $dbret['extra'];
      return(true);
    }
    return(false);
  }// ReadData()
}
