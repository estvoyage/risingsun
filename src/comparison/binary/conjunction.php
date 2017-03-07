<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, block\functor, oboolean };

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

	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, oboolean\recipient $recipient)
	{
		$this->container
			->payloadForBinaryComparisonContainerIteratorIs(
				$this->iterator,
				new conjunction\payload(
					$firstOperand,
					$secondOperand,
					$recipient
				)
			)
		;

		return $this;
	}
}
