<?php
/** shared
 *    classes/Groups.class.php
 *  
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    04.10.2008 - file created
 *
 *  (c) 2008 by Sascha Schneider
 */
 
class Group extends Base {

  private
    $id,
    
    $name,
    $description;

  protected function __contsruct($id=0) {
    parent::__construct();

    $this->id = (int)$id;
    if ( $this->id>0 && (! $this->ReadData()) ) {
      throw new Exception('Ungültige Id!');
    }
  }// Konstruktor

  public function GetById($id) {
    try {
      $ret = new Group($id);
    } catch (Exception $e) {
      panic($e);
    }
    return($ret);
  }// GetById()

  /**
   * getters / setters
   */
  public function Id() {
    /** int Group::Id()
     * Returns the group id.
     */
  	return($this->id);
  }// Id()
  
  public function Name($name='') {
  	/** string Group::Name(string $name)
     * Returns the name of the group or sets
     * the name to the committed value.
  	 */
    if ( ($this->IsValid($name)) ) {
    	$this->name = $name;
      if ( (int)$this->id>0 ) {
      	$sql = 'UPDATE usergroup SET name=:2 WHERE id=:1';
        try {
        	$this->dbh->prepare($sql)->execute($this->id, $name);
        } catch (MysqlException $e) {
        	panic($e);
        }
      }
    }
    return($this->name);
  }// Name()
  
  public function Description($description='') {
    /** string Group::Description(string $description)
     * Returns the description of the group or sets
     * the description to the committed value.
     */
    if ( ($this->IsValid($description)) ) {
      $this->description = $description;
      if ( (int)$this->id>0 ) {
        $sql = 'UPDATE usergroup SET name=:2 WHERE id=:1';
        try {
          $this->dbh->prepare($sql)->execute($this->id, $description);
        } catch (MysqlException $e) {
          panic($e);
        }
      }
    }
    return($this->description);
  }// Description()

  /**
   * public misc methods
   */
  public function Listing() {
    /** array Group::Listing()
     * Returns all groups as an array of object.
     */
    $dbh = Base::GetDbInstance();
    $sql = 'SELECT id FROM usergroup';
    try {
      $dbret = $dbh->prepare($sql)->execute()->fetchall_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }
    
    $ret = array();
    if ( is_array($dbret) && (! empty($dbret)) ) {
      foreach ($dbret as $dr) {
        $ret[] = self::GetById($dr['id']);
      }
    }
    return($ret);
  }// Listing()

  /**
   * private misc methods
   */
  protected function ReadData() {
    /** bool Group::ReadData()
     * Reads the Data for the group from the Database
     */
  	$sql = 'SELECT id, created, modified
                   name, description
              FROM usergroup
             WHERE id=:1';
    try {
      $dbret = $this->dbh->prepare($sql)->execute($this->id)->fetch-assoc();
    } catch (MysqlExceptio $e) {
      panic($e);
    }
    
    if ( is_array($dbret) && (! empty($dbret)) ) {
    	$this->created     = $dbret['created'];
      $this->modified    = $dbret['modified'];
      $this->name        = $dbret['name'];
      $this->description = $dbret['description'];
      
      return(true);
    }
    return(false);
  }// ReadData()
}
?>
