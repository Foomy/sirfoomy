<?php

/**
 * Form class for the prime number page.
 *
 * @author      Sascha Schneider <foomy.code@arcor.de>
 *
 * @category    form
 * @package     Form_Primenumber
 */
class Form_Primenumber extends Zend_Form
{
	const F_NAME = 'primenumber';

	const L_NUMBER = 'Zahl';
	const L_SUBMIT = 'Und ab!';

	public function init()
	{
		$this->addElements(array(
			$this->createNumberTextfield(),
			$this->createSubmitButton()
		));
	}

	/**
	 * Creates and returns a text field element for
	 * the primenumber.
	 *
	 * @return Zend_Form_Element_Text
	 */
	private function createNumberTextfield()
	{
		$element = new Zend_Form_Element_Text('number');
		$element->setLabel(self::L_NUMBER);

		return $element;
	}

	/**
	 * Creates and returns the submit button.
	 *
	 * @return Zend_Form_Element_Button
	 */
	protected function createSubmitButton()
	{
		$element = new Zend_Form_Element_Submit('submit');
		$element->setLabel(self::L_SUBMIT)
			->setAttribs(array(
				'class' => 'submitBtn green'
			));

		return $element;
	}

}