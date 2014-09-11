<?php

class LottoController extends Foo_Controller_Abstract
{
	const MAX_NUMBER_COMBINATIONS = 420;

	private $numberPool;
	private $combinations = array();

	public function indexAction()
	{
	}

	public function generateCombinationsAction()
	{
		if (!$this->isAjax()) {
			$this->redirect('/');
		}
		$this->disableViewScript();

		$this->numberPool = $this->getParam('numbers');

		do {
			$sixpack = $this->getSixNumbers();
			sort($sixpack);
			$hash = md5(implode(',', $sixpack));

			if (!isset($this->combinations[$hash])) {
				$this->combinations[$hash] = $sixpack;
			}
		}
		while (count($this->combinations) < self::MAX_NUMBER_COMBINATIONS);

		$this->_helper->json(array(
			'combinationsCount' => count($this->combinations),
			'combinations' => array_values($this->combinations)
		));
	}

	/**
	 * Gets a combination of 6 numbers out of the pool.
	 *
	 * @return array
	 */
	private function getSixNumbers()
	{
		$combo = array();

		do {
			$idx = mt_rand(0, count($this->numberPool) - 1);

			if (!in_array($this->numberPool[$idx], $combo)) {
				$combo[] = $this->numberPool[$idx];
			}
		}
		while (count($combo) < 6);

		return $combo;
	}
}
