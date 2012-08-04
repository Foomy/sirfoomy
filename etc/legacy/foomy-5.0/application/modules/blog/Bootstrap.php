<?php

/**
 * Bootstrap for the blog module
 *
 * @package blog
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Blog_Bootstrap extends Zend_Application_Module_Bootstrap {

  const DEBUG = false;

  /**
   * Read the config file and inits the blog.
   *
   * @return void
   */
  protected function _initBlog() {
/*
    $cfg = new Zend_Config_Ini(APPLICATION_PATH.'/modules/blog/configs/application.ini');
    $blog = Foomy_Blog_Model_Blog_Peer::getById($cfg->blog->activeBlog);
*/
  }// _initBlog()
}

/**
 * "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 * (James T. Kirk, Star Trek VI - Das unentdeckte Land)
 */
