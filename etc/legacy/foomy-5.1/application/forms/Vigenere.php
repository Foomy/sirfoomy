<?php

/**
 * Form for the Vigenère cipher demo
 *
 * @category    Foomy
 * @package     Form
 * @author      Sascha Schneider <foomy.code@arcor.de>
 */

class Form_Veginere extends Zend_Form
{
    public function init()
    {
        $key = new Zend_Form_Element_Text('key');
        $key->setLabel('Schlüssel')
            ->addFilter(new Zend_Filter_StripTags())
            ->addFilter(new Zend_Filter_StringTrim())
            ->addValidator(new Zend_Validate_Not_Empty());

        $cleartext = new Zend_Form_Element_Text('cleartext');
        $cleartext->setLabel('Klartext');


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
            $key, $cleartext,
            $dummy, $submit, $reset
        ));

    }
}
