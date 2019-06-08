<?php

/**
 * Login form
 *
 * @package default
 * @subpackage forms
 * @verions 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Form_DataArrayGenerator extends Zend_Form {

  const DEBUG = false;

  /**
   * Initialises the login form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'data-gen-form');

    $itemCount = new Zend_Form_Element_Text('itemcount');
    $itemCount->setLabel('Anzahl Elemente:');

    $rndTimestamp = new Zend_Form_Element_Checkbox('rndTimestamp');
    $rndTimestamp->setLabel('Zufällige Zeitstempel hinzufügen...');

    $timestampStart = new Zend_Form_Element_Text('timestampStart');
    $timestampStart->setLabel('Startzeitpunkt:');

    $timestampEnd = new Zend_Form_Element_Text('timestampEnd');
    $timestampEnd->setLabel('Endzeitpunkt:');  

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
    $submit->setLabel('Generieren')
           ->setAttrib('class', 'savebtn');

    $reset = new Zend_Form_Element_Reset('reset');
    $reset->setLabel('Zurücksetzen')
          ->setAttrib('class', 'cancelbtn');

    $this->addElements(array(
      $itemCount,
      $rndTimestamp, $timestampStart, $timestampEnd,
      $dummy, $submit, $reset
    ));
  }// init()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
