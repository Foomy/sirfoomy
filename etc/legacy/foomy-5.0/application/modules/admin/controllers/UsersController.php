<?php

/**
 * Controller for the user administration page.
 *
 * @package admin
 * @subpackage controller
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Admin_UsersController extends Foomy_Base_Controller {

  const DEBUG = false;

  public function init() {
    parent::init();
    $this->view->userlist = Foomy_Model_User_Peer::getList(false, true);
  }

  public function indexAction() {
    $form = new Foomy_Admin_Form_Users();
    $form->setAction($this->view->url(array('action' => '')));

    $request = $this->getRequest();
    if ( $request->isPost() && $form->isValid($request->getPost()) ) {
      $formValues = $form->getValues();

      if ( self::DEBUG ) {
        Zend_Debug::Dump($formValues);
      }

      if ( $formValues['password']===$formValues['password_wdh'] ) {
        if ( ($user = Foomy_Model_User_Peer::getById($formValues['user_id']))===null ) {
          // Create a new user
          $userTbl = new Foomy_Model_User_Peer();
          $user = $userTbl->createRow();
        }

        $user->setNickname($formValues['nickname']);
        $user->setEmail($formValues['email']);
        $user->setPassword($formValues['password']);
        $user->save();
      } else {
        $form->getElement('password')->setErrors('Passwörter stimmen nicht überein.');
      }
    }

    // Formular in die Ansicht einbinden.
    $this->view->form = $form;
  }// indexAction()

  public function editAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error    = false;
      $nickname = '';
      $email    = '';
      $password = '';
      $userId   = $this->getRequest()->getParam('userId');

      if ( ($user = Foomy_Model_User_Peer::getById($userId))!==null ) {
        $nickname = $user->getNickname();
        $email    = $user->getEmail();
        $password = $user->getPassword();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error'    => $error,
        'nickname' => $nickname,
        'email'    => $email,
        'password' => $password
      ));
    } else {
      // AJaX-Handler direkt aufrufen verboten!
      header('HTTP/1.1 404 Not Found');
    }
    exit;
  }// editAction()

  public function deleteAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error = false;
      $userId = $this->getRequest()->getParam('userId');

      if ( ($user = Foomy_Model_User_Peer::getById($userId))!==null ) {
        $user->delete();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error' => $error
      ));
    } else {
      // AJaX-Handler direkt aufrufen verboten!
      header('HTTP/1.1 404 Not Found');
    }
    exit;
  }// deleteAction()

  public function lockAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error  = false;
      $locked = false;
      $userId = $this->getRequest()->getParam('userId');

      if ( ($user = Foomy_Model_User_Peer::getById($userId))!==null ) {
        $locked = $user->lock();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error'  => $error,
        'locked' => $locked
      ));
    } else {
      // AJaX-Handler direkt aufrufen verboten!
      header('HTTP/1.1 404 Not Found');
    }
    exit;
  }// lockAction()

  public function unlockAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error  = false;
      $locked = false;
      $userId = $this->getRequest()->getParam('userId');

      if ( ($user = Foomy_Model_User_Peer::getById($userId))!==null ) {
        $locked = $user->unlock();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error'  => $error,
        'locked' => $locked
      ));
    } else {
      // AJaX-Handler direkt aufrufen verboten!
      header('HTTP/1.1 404 Not Found');
    }
    exit;
  }// unlockAction()

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
