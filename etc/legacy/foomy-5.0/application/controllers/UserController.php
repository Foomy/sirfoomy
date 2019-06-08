<?php

class UserController extends Foomy_Base_Controller {

  const DEBUG = false;

  public function init() {
    parent::init();
  }

  public function indexAction() {
  }

  public function loginAction() {
    $request = $this->getRequest();

    $form = new Foomy_Form_Login();
    $form->setAction($this->view->url(array('action' => 'login')));

    if ( $request->isPost() && $form->isValid($request->getPost()) ) {
      $formValues = $form->getValues();

      if ( self::DEBUG ) {
        Zend_Debug::Dump($formValues);
      }

      $authAdapter = new Foomy_Base_Auth_Adapter($formValues['email'], $formValues['password']);
      $authResult = $this->auth->authenticate($authAdapter);

      if ( $authResult->isValid() ) {
        if ( self::DEBUG ) {
          Zend_Debug::Dump($authResult->isValid(), '$authResult->isValid() => ');
          Zend_Debug::Dump($this->auth->getIdentity(), '$this->auth->getIdentity() => ');
        }

        $user = $this->auth->getIdentity();
        $storage = $this->auth->getStorage();
        $storage->write($user);
        return($this->_forward('index'));
      } else {
        $this->message = 'Benutzername oder Passwort falsch.';
      }
    }

    $this->view->form = $form;
  }

  public function logoutAction() {
    $auth = Zend_Auth::getInstance();
    $auth->clearIdentity();
  }
}
