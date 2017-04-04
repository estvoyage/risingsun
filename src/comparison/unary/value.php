<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\comparison;

class value
	implements
		comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct($reference = 0, comparison\binary $comparison = null)
	{
		$this->reference = $reference;
		$this->comparison = $comparison;
	}

	function operandForComparisonIs($value)
	{
		$this->comparison
			->referenceForComparisonWithOperandIs(
				$value,
				$this->reference
			)
		;

		return $this;
	}
}
