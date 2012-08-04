<?php

/**
 * Controller for the quote administration page.
 *
 * @package admin
 * @subpackage controller
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Admin_QuotesController extends Foomy_Base_Controller {

  const DEBUG = false;

  public function init() {
    parent::init();
    $this->view->quotelist = Foomy_Model_Quote_Peer::getList();
  }// init()

  public function indexAction() {
    $request = $this->getRequest();
    $form = new Foomy_Admin_Form_Quotes();
    
    // Setting target script.
    // Empty string as value for 'action' complies to $PHP_SELF
    $form->setAction($this->view->url(array('action' => '')));

    if ( $request->isPost() && $form->isValid($request->getPost()) ) {
      $formValues = $form->getValues();

      if ( self::DEBUG ) {
        Zend_Debug::Dump($formValues);
      }

      if ( ($quote = Foomy_Model_Quote_Peer::getById($formValues['quote_id']))===null ) {
        // Es wurde ein neues Zitat eingegeben.
        $quoteTbl = new Foomy_Model_Quote_Peer();
        $quote = $quoteTbl->createRow();
      }

      $quote->setAuthor($formValues['author']);
      $quote->setExtra($formValues['extra']);
      $quote->setQuoteText($formValues['quotetext']);
      $quote->save();
    }

    // Das Formular in die Ansicht einbinden.
    $this->view->form = $form;
  }// indexAction()

  public function editAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error     = false;
      $quotetext = '';
      $author    = '';
      $extra     = '';
      $quoteId   = $this->getRequest()->getParam('quoteId');

      if ( ($quote = Foomy_Model_Quote_Peer::getById($quoteId))!==null ) {
        $quotetext = $quote->getQuoteText();
        $author    = $quote->getAuthor();
        $extra     = $quote->getExtra();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error'  => $error,
        'text'   => $quotetext,
        'author' => $author,
        'extra'  => $extra
      ));    
    } else {
      // Ajax-Handler direkt aufrufen is nich!
      header('HTTP/1.1 404 Not Found');
    }

    exit;
  }// editAction()

  public function deleteAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $error   = false;
      $quoteId = $this->getRequest()->getParam('quoteId');

      if ( ($quote = Foomy_Model_Quote_Peer::getById($quoteId))!==null ) {
        $quote->delete();
      } else {
        $error = true;
      }

      echo json_encode(array(
        'error' => $error
      ));
    } else {
      // AJaX-Handler direkt aufrufen is nich!
      header('HTTP/1.1 404 Not Found');
    }
  }// deleteAction()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
