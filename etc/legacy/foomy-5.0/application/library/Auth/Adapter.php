<?php

/**
 * Auth adapter class
 *
 * @package default
 * @subpackage library
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Base_Auth_Adapter implements Zend_Auth_Adapter_Interface {

  const DEBUG = false;

  private $email    = null;
  private $password = null;

  public function __construct($email, $password) {
    $this->email    = $email;
    $this->password = $password;
  }// __construct()

  public function authenticate() {
    if ( self::DEBUG ) {
      Zend_Debug::Dump($this->email, 'Foomy_Base_Auth_Adapter::email => ');
      Zend_Debug::Dump($this->password, 'Foomy_Base_Auth_Adapter::password => ');
    }

    $code = Zend_Auth_Result::FAILURE;
    $user = Foomy_Model_User_Peer::getByEmail($this->email);
    if ( self::DEBUG ) {
      Zend_Debug::Dump($user->getId(), '$user->id => ');
    }

    if ( $user===null || $user->isLocked() ) {
      $code = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
    } else {
      if ( $user->checkPassword($this->password) ) {
        $code = Zend_Auth_Result::SUCCESS;
      } else {
        $code = Zend_Auth_Resuls::FAILURE_CREDENTIAL_INVALID;
      }
    }

    return(new Zend_Auth_Result($code, ($user!==null) ? $user : $this->email));
  }// authenticate()

}
