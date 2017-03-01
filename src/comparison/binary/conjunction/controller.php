<?php namespace estvoyage\risingsun\comparison\binary\conjunction;

use estvoyage\risingsun\{ container, comparison };

class controller extends container\iterator\controller\stopper
	implements
		container\iterator\controller
{
	private
		$recipient
	;

	function __construct(comparison\recipient $recipient, container\iterator\engine $engine = null)
	{
		parent::__construct($engine);

		$this->recipient = $recipient;
	}

	function containerIteratorHasNoMoreIteration()
	{
		$this->recipient->comparisonIsTrue();

		return parent::containerIteratorEngineHasNoMoreIteration();
	}

	function remainingIterationsAreUseless()
	{
		$this->recipient->comparisonIsFalse();

		return parent::remainingIterationsAreUseless();
	}
}
