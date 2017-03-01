<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\comparison;

class value
	implements
		comparison\unary
{
	private
		$value,
		$comparison
	;

	function __construct($value = 0, comparison\binary $comparison = null)
	{
		$this->value = $value;
		$this->comparison = $comparison ?: new comparison\binary\equal;
	}

	function recipientOfComparisonWithValueIs($value, comparison\recipient $recipient)
	{
		$this->comparison
			->recipientOfComparisonBetweenValuesIs(
				$this->value,
				$value,
				$recipient
			)
		;

		return $this;
	}
}
