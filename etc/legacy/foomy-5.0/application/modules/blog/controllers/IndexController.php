<?php

/**
 * Controller class for the blog main page.
 *
 * @package blog
 * @subpackage controller
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Blog_IndexController extends Foomy_Base_Controller {
  public function init() {
    parent::init();
  }

  public function indexAction() {
    $this->view->blog = Foomy_Blog_Model_Blog_Peer::getById(1);
  }
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
