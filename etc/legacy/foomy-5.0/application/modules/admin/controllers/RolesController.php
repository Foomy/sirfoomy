<?php

/**
 * Controller for the user administration page.
 *
 * @package admin
 * @subpackage controller
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Admin_RolesController extends Foomy_Base_Controller {

  const DEBUG = false;

  public function init() {
    parent::init();
    $this->view->rolelist = Foomy_Model_Role_Peer::getList();
  }

  public function indexAction() {
    $form = new Foomy_Admin_Form_Roles();
    $form->setAction($this->view->url(array('action' => '')));

    $request = $this->getRequest();
    if ( $request->isPost() && $form->isValid($request->getPost()) ) {
      $formValues = $form->getValues();

      if ( self::DEBUG ) {
        Zend_Debug::Dump($formValues);
      }

      if ( ($role = Foomy_Model_Role_Peer::getById($formValues['role_id']))===null ) {
        $roleTbl = new Foomy_Model_Role_Peer();
        $role = $roleTbl->createRow();
      }

      $role->setName($formValues['name']);
      $role->setDescription($formValues['description']);
      $role->save();
    }

    // Formular in die Ansicht einbinden.
    $this->view->form = $form;
  }// indexAction()

  public function editAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error  = false;
      $name   = '';
      $desc   = '';
      $roleId = $this->getRequest()->getParam('roleId');

      if ( ($role = Foomy_Model_Role_Peer::getById($roleId))!==null ) {
        $name = $role->getName();
        $desc = $role->getDescription();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error'       => $error,
        'name'        => $name,
        'description' => $desc
      ));
    } else {
      // AJaX-Handler direkt aufrufen verboten!
      header('HTTP/1.1 404 Not Found');
    }
    exit;
  }// editAction()

  public function deleteAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error  = false;
      $roleId = $this->getRequest()->getParam('roleId');

      if ( ($role = Foomy_Model_Role_Peer::getById($roleId))!==null ) {
        $role->delete();
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

}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
