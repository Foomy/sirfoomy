<?php

/**
 * Login form
 *
 * @package default
 * @subpackage forms
 * @verions 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Form_Login extends Zend_Form {

  const DEBUG = false;

  /**
   * Initialises the login form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'loginform');

    $email = new Zend_Form_Element_Text('email');
    $email->setLabel('E-Mail:')
          ->setRequired(true)
          ->addFilter(new Zend_Filter_StripTags())
          ->addFilter(new Zend_Filter_StringTrim())
          ->addValidator(new Zend_Validate_NotEmpty())
          ->addValidator(new Zend_Validate_EmailAddress());

    $password = new Zend_Form_Element_Password('password');
    $password->setLabel('Passwort:')
             ->setRequired(true)
             ->addValidator(new Zend_Validate_NotEmpty());

    $dummy = new Zend_Form_Element_Hidden('dummy');
    $dummy->addDecorators(array(
      array('ViewHelper'),
      array('Errors'),
      array('HtmlTag', array(
        'tag' => 'dd',
        'class' => 'last-field'
      )),
      array('Label', array('tag' => 'dt'))
    ));

    $submit = new Zend_Form_Element_Submit('submit');
    $submit->setLabel('Einloggen')
           ->setAttrib('class', 'savebtn');

    $reset = new Zend_Form_Element_Reset('reset');
    $reset->setLabel('Zurücksetzen')
          ->setAttrib('class', 'cancelbtn');

    $this->addElements(array(
      $email, $password,
      $dummy, $submit, $reset
    ));
  }// init()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
