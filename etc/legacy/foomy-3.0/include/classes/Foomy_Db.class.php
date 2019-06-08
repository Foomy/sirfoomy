<?php
/**
 *    file: classes/Foomy_Db.class.php
 * project: Foomys Welt
 *  author: Sascha 'Foomy' Schneider
 * created: 1131741541
 *
 */
 
require_once('classes/Db.class.php');

class Foomy_Db extends Db {
 var $stamp;

 function &getInstance() {
  static $inst = null;
 
  if ( ! is_object($inst) ) {
   $inst = new Foomy_Db();
  }

  $ret = &$inst;
  return $ret;
 }//get_instance() 
 
 function Foomy_Db() {
  $this->db   = 'foomy';
  $this->host = 'localhost';
  $this->user = 'foomy_web';
  $this->pwd  = 'MVemjSu9P.';
  
  $this->stamp = microtime();
  $this->Db();
 }//Konstruktor()
}//Del Fin!
?>
