<?php

/**
 * Form for adding or editing a article for the blog
 *
 * @package blog
 * @subpackage forms
 * @version 5.0
 * @author Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Blog_Form_Article extends Zend_Form {

  const DEBUG = false;

  /**
   * Initializes the form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'articleform');

    // Initialize the native form elements
    $article_id = new Zend_Form_Element_Hidden('article_id');
    $blog_id = new Zend_Form_Element_Hidden('blog_id');

    $headline = new Zend_Form_Element_Text(Foomy_Blog_Model_Article_Peer::F_HEADLINE);
    $headline->setLabel('Schlagzeile:')
             ->setRequired(true)
             ->addFilter(new Zend_Filter_StripTags())
             ->addFilter(new Zend_Filter_StringTrim())
             ->addValidator(new Zend_Validate_NotEmpty());

    $subhead = new Zend_Form_Element_Text(Foomy_Blog_Model_Article_Peer::F_SUBHEAD);
    $subhead->setLabel('Untertitel:')
            ->setRequired(false)
            ->addFilter(new Zend_Filter_StripTags())
            ->addFilter(new Zend_Filter_StringTrim());

    $abstract = new Zend_Form_Element_Textarea('abstract');
    $abstract->setLabel('Abriss:')
             ->setRequired(false)
             ->addFilter(new Zend_Filter_StripTags())
             ->addFilter(new Zend_Filter_StringTrim());

    $add_paragraph = new Zend_Form_Element_Button('add_paragraph');
    $add_paragraph->setLabel('Textabschnitt hinzufügen');

    $submit = new Zend_Form_Element_Submit('submit');
    $submit->setLabel('Abschicken')
           ->setAttrib('class', 'savebtn');

    $reset = new Zend_Form_Element_Reset('reset');
    $reset->setLabel('Zurücksetzen')
          ->setAttrib('class', 'cancelbtn');

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

    // Initalize the SubForm for the first paragraph.
    $pSubForm = new Foomy_Blog_Form_Paragraph();

    // At last, we have to add all elements to the form.
    $this->addElements(array(
      $article_id, $blog_id, $headline, $subhead, $abstract
    ));
    $this->addSubForm($pSubForm, 'pSubForm_0');
    $this->addElements(array(
      $dummy, $submit, $reset, $add_paragraph
    ));
  }// init() 
}

/**
 * "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 * James T. Kirk; Star Trek VI - Das unentdeckte Land
 */
