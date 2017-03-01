<?php namespace estvoyage\risingsun\comparison\conjunction;

use estvoyage\risingsun\{ container, block, comparison };

class controller extends container\iterator\controller\stopper
	implements
		container\iterator\controller
{
	private
		$recipient
	;

	function __construct(comparison\recipient $recipient, block $stopBlock = null)
	{
		parent::__construct($stopBlock);

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
