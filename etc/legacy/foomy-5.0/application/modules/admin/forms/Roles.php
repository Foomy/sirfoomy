<?php

/**
 * Admin form for managing the user roles.
 *
 * @package admin
 * @subpackage forms
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Admin_Form_Roles extends Zend_Form {

  const DEBUG = false;

  /**
   * Initialises the form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'roleform');

    $role_id = new Zend_Form_Element_Hidden('role_id');
    $role_id->setLabel('');

    $name = new Zend_Form_Element_Text(Foomy_Model_Role_Peer::F_NAME);
    $name->setLabel('Name:')
         ->setRequired(true)
         ->addFilter(new Zend_Filter_StripTags())
         ->addFilter(new Zend_Filter_StringTrim())
         ->addValidator(new Zend_Validate_NotEmpty());

    $desc = new Zend_Form_Element_Textarea(Foomy_Model_Role_Peer::F_DESCRIPTION);
    $desc->setLabel('Beschreibung:')
         ->addFilter(new Zend_Filter_StripTags())
         ->addFilter(new Zend_Filter_StringTrim());
    $desc->addDecorators(array(
      array('ViewHelper'),
      array('Errors'),
      array('HtmlTag', array(
        'tag' => 'dd',
        'id' => 'description-element',
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
      $role_id, $name, $desc,
      $submit, $reset
    ));
  }// init()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
