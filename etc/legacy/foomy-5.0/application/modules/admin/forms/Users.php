<?php

/**
 * Admin form to manage users.
 *
 * @package admin
 * @subpackage forms
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Admin_Form_Users extends Zend_Form {

  const DEBUG = false;

  /**
   * Initialises the form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'userform');

    $user_id = new Zend_Form_Element_Hidden('user_id');
    $user_id->setLabel('');

    $nickname = new Zend_Form_Element_Text(Foomy_Model_User_Peer::F_NICKNAME);
    $nickname->setLabel('Nickname:')
             ->setRequired(true)
             ->addFilter(new Zend_Filter_StripTags())
             ->addFilter(new Zend_Filter_StringTrim())
             ->addValidator(new Zend_Validate_NotEmpty());

    $email = new Zend_Form_Element_Text(Foomy_Model_User_Peer::F_EMAIL);
    $email->setLabel('E-Mail:')
          ->setRequired(true)
          ->addFilter(new Zend_Filter_StripTags())
          ->addFilter(new Zend_Filter_StringTrim())
          ->addValidator(new Zend_Validate_EmailAddress());

    $password = new Zend_Form_Element_Password(Foomy_Model_User_Peer::F_PASSWORD);
    $password->setLabel('Passwort:')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_NotEmpty())
             ->addValidator(new Zend_Validate_StringLength(6, 50));

    $password_wdh = new Zend_Form_Element_Password('password_wdh');
    $password_wdh->setLabel('Passwort (wdh):')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_NotEmpty())
             ->addValidator(new Zend_Validate_StringLength(6, 50));
//             ->addValidator(new Zend_Validate_Identical($password->getValue()));

    $roles   = Foomy_Model_Role_Peer::getList();
    $roleFld = new Zend_Form_Element_Select('role');
    $roleFld->setLabel('Gruppe:');
    foreach ($roles as $role) {
      $roleFld->addMultiOption($role->getId(), $role->getName());
    }
    $roleFld->setValue(4);

    $dummy = new Zend_Form_Element_Hidden('dummy');
    $dummy->setLabel('')
          ->addDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('HtmlTag', array(
              'tag' => 'dd',
              'id' => 'password-element',
              'class' => 'last-field'
            )),
            array('Label', array('tag' => 'dt'))
          ));

    $submit = new Zend_Form_Element_Submit('submit');
    $submit->setLabel('Abschicken')
           ->setAttrib('class', 'savebtn');

    $reset = new Zend_Form_Element_Reset('reset');
    $reset->setLabel('Zurücksetzen')
          ->setAttrib('class', 'cancelbtn');

    $this->addElements(array(
      $user_id, $nickname, $email, $password, $password_wdh,
      $roleFld, $dummy, $submit, $reset
    ));
  }// init()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
