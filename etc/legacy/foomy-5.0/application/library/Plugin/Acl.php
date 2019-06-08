<?php

/**
 * Front Controller Plugin for the access control list.
 *
 * @package default
 * @subpackage library
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Base_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
  public function preDispatch(Zend_Controller_Request_Abstract $request) {
    // Set up acl.
    $acl = new Zend_Acl();

    // Add the roles.
    $roles = Foomy_Model_Role_Peer::getList();
    foreach ($roles as $role) {
      $parentRole = Foomy_Model_Role_Peer::getById($role->getRoleId());
      if ( $role->getRoleId()>0 ) {
        $acl->addRole(new Zend_Acl_Role($role->getName(), $parentRole->getName()));
      } else {
        $acl->addRole(new Zend_Acl_Role($role->getName()));
      }
    }

    /**
     * Add resources.
     */

    // For the default module.
    $acl->add(new Zend_Acl_Resource('error'));
    $acl->add(new Zend_Acl_Resource('index'));
    $acl->add(new Zend_Acl_Resource('home'));
    $acl->add(new Zend_Acl_Resource('impressum'));
    $acl->add(new Zend_Acl_Resource('user'));
    $acl->add(new Zend_Acl_Resource('bastel'));

    // For the admin module.
    $acl->add(new Zend_Acl_Resource('quotes'));
    $acl->add(new Zend_Acl_Resource('roles'));
    $acl->add(new Zend_Acl_Resource('users'));

    // For the blog module
    $acl->add(new Zend_Acl_Resource('blog_index'));
    $acl->add(new Zend_Acl_Resource('blog_article'));
    
    /**
     * Set up the access rules.
     */
    $acl->allow(null, array('index', 'error'));

    // A guest can only read content and login.
    $acl->allow('guest', 'error', array('error'));
    $acl->allow('guest', 'index', array('index'));
    $acl->allow('guest', 'home', array('index'));
    $acl->allow('guest', 'impressum', array('index'));
    $acl->allow('guest', 'user', array('login'));

    // A user can also work with content (writing comments, etc.)


    // A administrator can do anything
    $acl->allow('admin', null);

    // Fetch the currentUser
    $auth = Zend_Auth::getInstance();
    if ( $auth->hasIdentity() ) {
      $user = $auth->getIdentity();
      $role = $user->getRole();
    } else {
      $role = 'guest';
    }

    $controller = $request->controller;
    $action     = $request->action;

    if ( ! $acl->isAllowed($role, $controller, $action) ) {
      if ( $role=='guest' ) {
        $request->setControllerName('user');
        $request->setActionName('login');
      } else {
        $request->setControllerName('error');
        $request->setActionName('noauth');
      }
    }
  }
}
