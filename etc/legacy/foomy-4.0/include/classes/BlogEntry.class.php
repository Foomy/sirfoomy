<?php

class Blogentry extends Base {
  
  private
    $id,
    
    $message,
    $headline,
    $subhead,

    $tags,
    $links,
    
    $regex;
    
  public function __construct($id=0) {
  	parent::__construct();

    $this->id = (int)$id;
    if ( $this->id>0 && (! $this->ReadData()) ) {
    	throw new Exception('Ungültige Blogentry-Id!');
    }
    
    $this->regex = '!\bhttps?://([\w\-]+\.)+[a-zA-Z]{2,3}(/(\S+)?)?\b!';
  }// Konstruktor

  public function GetById($id) {
   try {
   	$ret = new Blogentry($id);
   } catch (Exception $e) {
   	panic($e);
   }
   return($ret);
  }// GetById()

  public function GetMessage() {
    return($this->message);
  }// GetMessage()

  public function GetHeadline() {
    return($this->headline);
  }// GetHeadline()

  public function GetSubhead() {
    return($this->subhead);
  }// GetSubhead()

  private function GetLinks() {
    $dbo = Base::GetDbInstance();
    $sql = 'SELECT link_id
              FROM link2blogentry
             WHERE blogentry_id=:1';
    try {
      $dbret = $dbo->prepare($sql)->execute($this->id)->fetchall_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }
    
    if ( is_array($dbret) && (! empty($dbret)) ) {
      foreach ($dbret as $dr) {
        $ret[] = Link::GetById($dr['id']);
      }
      return($ret);
    }
    return(false);
  }// GetLinks()

  protected function ReadData() {
    $sql = 'SELECT message, headline, subhead,
                   created, modified
              FROM blogentry
             WHERE id=:1';
    try {
      $dbret = $this->dbo->prepare($sql)->execute($this->id)->fetch_assoc();
    } catch (MysqlException $e) {
      panic($e);
    }
    
    if ( is_array($dbret) ) {
      $this->message  = $dbret['message'];
      $this->headline = $dbret['headline'];
      $this->subhead  = $dbret['subhead'];

      $this->created  = $dbret['created'];
      $this->modified = $dbret['modified'];
      
      $this->links    = $this->GetLinks();
      return(true);
    }
    return(false);
  }// ReadData()
}// class Blogentry
