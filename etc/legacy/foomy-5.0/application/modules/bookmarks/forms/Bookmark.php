<?php

/**
 * Form for editing bookmarks
 *
 * @category    Foomy
 * @package     Foomy_Bookmarks
 * @subpackage  Forms
 * @version     5.0
 * @author      Sascha Schneider <foomy.code@arcor.de>
 */

class Foomy_Bookmarks_Form_Bookmark extends Zend_Form {

  const DEBUG = false;

  /**
   * Initialises quote form
   *
   * @param void
   * @return void
   */
  public function init() {
    $this->setMethod('post');
    $this->setAttrib('id', 'bookmarkform');

    $bookmark_id = new Zend_Form_Element_Hidden('bookmark_id');

    $href = new Zend_Form_Element_Text(Foomy_Bookmarks_Model_Bookmark_Peer::F_HREF);
    $href->setLabel('Verweis:')
         ->setRequired(true)
         ->addFilter(new Zend_Filter_StripTags())
         ->addFilter(new Zend_Filter_StringTrim())
         ->addValidator(new Zend_Validate_NotEmpty());

    $title = new Zend_Form_Element_Text(Foomy_Bookmarks_Model_Bookmark_Peer::F_TITLE);
    $title->setLabel('Titel:')
          ->setRequired(true)
          ->addFilter(new Zend_Filter_StripTags())
          ->addFilter(new Zend_Filter_StringTrim())
          ->addValidator(new Zend_Validate_NotEmpty());

    $comment = new Zend_Form_Element_Textarea(Foomy_Bookmarks_Model_Bookmark_Peer::F_COMMENT);
    $comment->setLabel('Kommentar:')
            ->setRequired(false)
            ->addFilter(new Zend_Filter_StripTags())
            ->addFilter(new Zend_Filter_StringTrim());

    $picture = new Zend_Form_Element_Text(Foomy_Bookmarks_Model_Bookmark_Peer::F_PICTURE);
    $picture->setLabel('Vorschaubild:')
            ->setRequired(false)
            ->addFilter(new Zend_Filter_StripTags())
            ->addFilter(new Zend_Filter_StringTrim());

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
    $submit->setLabel('Abschicken')
           ->setAttrib('class', 'savebtn');

    $reset = new Zend_Form_Element_Reset('reset');
    $reset->setLabel('Zurücksetzen')
          ->setAttrib('class', 'cancelbtn');

    $this->addElements(array(
      $href, $title, $comment, $picture,
      $dummy, $submit, $reset
    ));
  }// init()
}

/**
 *  "Wenn wir heute noch was vermasseln können, sagt mir bescheid!"
 *  (James T. Kirk, Star Trek VI - Das unendeckte Land)
 */
