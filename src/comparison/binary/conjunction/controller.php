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

	function endOfIterations()
	{
		$this->recipient->comparisonIsTrue();

		return parent::endOfIterations();
	}

	function nextIterationsAreUseless()
	{
		$this->recipient->comparisonIsFalse();

		return parent::nextIterationsAreUseless();
	}
}
