<?php
/** foomy.net
 *    classes/Link.class.php
 * 
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 *
 *  history
 *    09.08.2008 - file created
 * 
 * mysql> desc blog;
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | Field    | Type                | Null | Key | Default             | Extra          |
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | id       | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | created  | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | title    | varchar(30)         | YES  |     | NULL                |                |
 * | subtitle | varchar(30)         | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 *
 * mysql> desc blogentry;
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | Field    | Type                | Null | Key | Default             | Extra          |
 * +----------+---------------------+------+-----+---------------------+----------------+
 * | id       | bigint(20) unsigned | NO   | PRI | NULL                | auto_increment |
 * | blog_id  | bigint(20) unsigned | NO   |     |                     |                |
 * | created  | timestamp           | NO   |     | CURRENT_TIMESTAMP   |                |
 * | modified | timestamp           | NO   |     | 0000-00-00 00:00:00 |                |
 * | message  | varchar(4096)       | YES  |     | NULL                |                |
 * | headline | varchar(50)         | YES  |     | NULL                |                |
 * | subhead  | varchar(50)         | YES  |     | NULL                |                |
 * +----------+---------------------+------+-----+---------------------+----------------+
 *
 */
 
class Blog extends Base {
  
  private
    $id,
    
    $title,
    $subtitle,

    $entrys;
    
  public function __construct($id=0) {
    parent::__construct();
    
    $this->id = (int)$id;
    if ( $this->id>0 && (! $this->ReadData()) ) {
      throw new Exception('Ungültige Blog-Id!');
    }
    $this->GetEntrys();
  }// Konstruktor

  public function GetById($id) {
  	try {
  		$ret = new Blog($id);
  	} catch (Exception $e) {
  		panic($e);
  	}
    return($ret);
  }// GetById()
  
  /** GETTERS
   */
  public function GetTitle() {
    if ( $this->IsValid($this->title) ) {
      return($this->title);
    }
    return(false);
  }// GetTitle()

  public function GetSubtitle() {
    if ( $this->IsValid($this->subtitle) ) {
      return($this->subtitle);
    }
    return(false);
  }// GetSubtitle();

  public function GetEntrys() {
    if ( $this->id>0 && (! $this->IsValid($this->entrys)) ) {
      $sql = 'SELECT id FROM blogentry WHERE blog_id=:1 AND deleted=0';
      try {
        $dbret = $this->dbo->prepare($sql)->execute($this->id)->fetchall_assoc();
      } catch (MysqlException $e) {
        panic($e);
      }

      if ( is_array($dbret) && (! empty($dbret)) ) {
        foreach ($dbret as $dr) {
          $this->entrys[] = Blogentry::GetById($dr['id']);
        }
        return($this->entrys);
      }
      return(false);
    }
    return($this->entrys);
  }// GetEntrys()

  /** SETTERS
   */

  /** MISC METHODS
   */
  protected function ReadData() {
    if ( $this->IsValid($this->id) ) {
      $sql = 'SELECT title, subtitle
                FROM blog
               WHERE id=:1';
      try {
        $dbret = $this->dbo->prepare($sql)->execute($this->id)->fetch_assoc();
      } catch (MysqlException $e) {
        panic($e);
      }

      if ( is_array($dbret) ) {
        $this->title = $dbret['title'];
        $this->subtitle = $dbret['subtitle'];
      }
      return(true);
    }
    return(false);
  }// ReadData()

}//class Blog
