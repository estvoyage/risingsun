<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean, block\functor };

class conjunction
	implements
		comparison
{
	private
		$container,
		$iterator
	;

	function __construct(comparison\container $container, comparison\container\iterator $iterator)
	{
		$this->container = $container;
		$this->iterator = $iterator;
	}

	function recipientOfComparisonBetweenValuesIs($firstOperand, $secondOperand, comparison\recipient $recipient)
	{
		$this->container
			->controllerOfPayloadForComparisonContainerIteratorIs(
				new comparison\conjunction\payload(
					$firstOperand,
					$secondOperand
				),
				$this->iterator,
				new comparison\conjunction\controller(
					$recipient
				)
			)
		;

		return $this;
	}
}
