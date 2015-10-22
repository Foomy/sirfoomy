<?php

namespace Application\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Email;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;
use Zend\I18n\Translator\Translator;

/**
 * Form class for the contact form of SirFoomys Welt.
 *
 * @author  Sascha Schneider <foomy.code@arcor.de>
 * @package Application\Form
 */
class Contact extends Form
{
  public function __construct($name = '', Translator $translator = null)
  {
    parent::__construct('contact');
    $this->setAttribute('method', 'post');

    $this->add(array(
      'type'       => Text::class,
      'name'       => 'name',
      'attributes' => array(
        'id'          => 'name',
        'class'       => 'form-control',
        'placeholder' => 'Ihr Name'
      ),
      'options'    => array(
        'label'            => 'Name',
        'label_attributes' => array(
          'class' => 'control-label required'
        )
      )
    ));

    $this->add(array(
      'type'       => Email::class,
      'name'       => 'email',
      'attributes' => array(
        'id'    => 'email',
        'class' => 'form-control'
      ),
      'options'    => array(
        'label'            => 'E-Mail',
        'label_attributes' => array(
          'class' => 'control-label required'
        )
      )
    ));

    $this->add(array(
      'type'       => Textarea::class,
      'name'       => 'message',
      'attributes' => array(
        'id' => 'message',
        'class' => 'form-control'
      ),
      'options'    => array(
        'label' => 'Nachricht',
        'label_attributes' => array(
          'class' => 'control-label required'
        )
      ),
    ));


    $this->add(array(
      'type'       => Button::class,
      'name'       => 'cancel',
      'attributes' => array(
        'id'    => 'cancel-button',
        'class' => 'btn btn-cancel'
      ),
      'options' => array(
        'label' => 'Abbrechen'
      )
    ));

    $this->add(array(
      'type'       => Submit::class,
      'name'       => 'submit',
      'attributes' => array(
        'type'  => 'submit',
        'value' => 'Speichern',
        'id'    => 'submit-button',
        'class' => 'btn btn-success'
      ),
    ));
  }
}


/**
 * "Please let me know if there is some other way we can screw up tonight."
 * (James T. Kirk, Star Trek VI - The Undiscovered Country)
 */
