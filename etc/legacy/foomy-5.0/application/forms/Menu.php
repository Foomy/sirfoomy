<?php

class Foomy_Form_Menu extends Zend_Form {

  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'createMenuForm');

    $menu_id = new Zend_Form_Element_Hidden('menu_id');

    $name = new Zend_Form_Element_Text('name');
    $name->setLabel('Name: ')
         ->setRequired(true)
         ->setAttrib('size', 40)
         ->addFilter('StripTags');

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
    $submit->setLabel('Erstellen')
           ->setAttrib('class', 'savebtn');

    $reset = new Zend_Form_Element_Reset('reset');
    $reset->setLabel('Zurücksetzen')
          ->setAttrib('class', 'cancelbtn');

    $this->addElements(array(
      $menu_id, $name,
      $dummy, $submit, $reset
    ));
  }
}
