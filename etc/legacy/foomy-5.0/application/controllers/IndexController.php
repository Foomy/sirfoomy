<?php

/**
 * Controller for the splash screen.
 *
 * @package default
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class IndexController extends Foomy_Base_Controller {
  public function init() {
    parent::init();
  }

  public function indexAction() {
    $this->view->quote = Foomy_Model_Quote_Peer::getRandom();
  }
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
