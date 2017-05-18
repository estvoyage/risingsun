<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\comparison;

class any
	implements
		comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct($reference, comparison\binary $comparison)
	{
		$this->reference = $reference;
		$this->comparison = $comparison;
	}

	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient) :void
	{
		$this->comparison
			->recipientOfComparisonBetweenOperandAndReferenceIs(
				$operand,
				$this->reference,
				$recipient
			)
		;
	}
}
