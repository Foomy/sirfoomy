<?php

/**
 * Controller for the site notice page.
 *
 * @package default
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class ImpressumController extends Foomy_Base_Controller {

  public function init() {
    parent::init();

    $contextSwitch = $this->_helper->getHelper('contextSwitch');
    $contextSwitch->addActionContext('getimage', 'json')
                  ->initContext();
  }// init()

  public function indexAction() {
  }// indexAction()

  /**
   * Ajax-Handler für das Impressums-Image
   */
  public function getimageAction() {
    if ( $this->getRequest()->isXmlHttpRequest() ) {
      $img  = '<div style="background:url(/img/impressum.png) no-repeat;">';
      $img .= '<img src="/img/blank.gif" class="imgprot" />';
      $img .= '</div>';
      echo json_encode(array('img' => $img));
    } else {
      // Ajax-Handler direkt aufrufen is nich!
      header('HTTP/1.1 404 Not Found');
    }

    exit;
  }// getimageAction()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
