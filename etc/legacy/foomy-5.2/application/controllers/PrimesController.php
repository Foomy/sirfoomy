<?php

class PrimesController extends Foo_Controller_Abstract
{
	public function indexAction()
	{
		$this->view->layout = 'oneCol';

		$primes = null;
		$form   = new Form_Primenumber();

		if ($this->getRequest()->isPost()) {
			if ($form->isValid($this->getRequest()->getPost())) {
				$number = $form->getValue('number');
				$primes = new Foo_Math_Primes($number);
			}
		}

		$this->view->form   = $form;
		$this->view->primes = $primes;
	}
}