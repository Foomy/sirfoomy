<?php

/**
 * Subform for the text paragraph for the article form.
 *
 * @package blog
 * @subpackage forms
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Blog_Form_Paragraph extends Zend_Form_SubForm {

  const DEBUG = false;

  /**
   * Initialises the subform
   *
   * @param void
   * @return void
   */
  public function init() {
    $paragraph = new Zend_Form_Element_Textarea('paragraph');
    $paragraph->setLabel('Text:')
              ->setAttrib('class', 'paragraph')
              ->setRequired(false)
              ->addFilter(new Zend_Filter_StripTags())
              ->addFilter(new Zend_Filter_StringTrim());

    $this->addElement($paragraph);
  }// init()

}

/**
 * "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 * James T. Kirk; Star Trek VI - Das unentdeckte Land
 */
