<?php

/**
 * Admin form for the quotes
 *
 * @package admin
 * @subpackage forms
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Admin_Form_Quotes extends Zend_Form {

  const DEBUG = false;

  /**
   * Initialises quote form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'quoteform');

    $quote_id = new Zend_Form_Element_Hidden('quote_id');

    $author = new Zend_Form_Element_Text(Foomy_Model_Quote_Peer::F_AUTHOR);
    $author->setLabel('Autor:')
           ->setRequired(true)
           ->addFilter(new Zend_Filter_StripTags())
           ->addFilter(new Zend_Filter_StringTrim())
           ->addValidator(new Zend_Validate_NotEmpty())
           ->setErrorMessages(array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Bitte »Autor« ausfüllen.'
             ));

    $extra = new Zend_Form_Element_Text(Foomy_Model_Quote_Peer::F_EXTRA);
    $extra->setLabel('Zusatzinfos:')
          ->setRequired(false)
          ->addFilter(new Zend_Filter_StripTags())
          ->addFilter(new Zend_Filter_StringTrim());

    $quotetext = new Zend_Form_Element_Textarea(Foomy_Model_Quote_Peer::F_QUOTETEXT);
    $quotetext->setLabel('Zitattext:')
              ->setRequired(true)
              ->addFilter(new Zend_Filter_StripTags())
              ->addFilter(new Zend_Filter_StringTrim())
              ->addValidator(new Zend_Validate_NotEmpty())
              ->setErrorMessages(array(
                    Zend_Validate_NotEmpty::IS_EMPTY => 'Bitte »Zitattext« ausfüllen.'
                ));
    $quotetext->addDecorators(array(
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
      $quote_id, $author, $extra,
      $quotetext, $submit, $reset
    ));
  }// init()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
