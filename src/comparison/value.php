<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\comparison;

class value
	implements
		comparison
{
	private
		$value,
		$comparison
	;

	function __construct($value, comparison\unary $comparison)
	{
		$this->value = $value;
		$this->comparison = $comparison;
	}

	function recipientOfComparisonIs(comparison\recipient $recipient)
	{
		$this->comparison
			->recipientOfComparisonWithValueIs(
				$this->value,
				$recipient
			)
		;

		return $this;
	}
}
