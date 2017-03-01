<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, block\functor };

class conjunction
	implements
		comparison\binary
{
	private
		$container,
		$iterator
	;

	function __construct(comparison\binary\container $container, comparison\binary\container\iterator $iterator)
	{
		$this->container = $container;
		$this->iterator = $iterator;
	}

	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, comparison\recipient $recipient)
	{
		$this->container
			->controllerOfPayloadForBinaryComparisonContainerIteratorIs(
				new conjunction\payload(
					$firstOperand,
					$secondOperand
				),
				$this->iterator,
				new conjunction\controller(
					$recipient
				)
			)
		;

		return $this;
	}
}
