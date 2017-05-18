<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\comparison;

class not
	implements
		comparison\unary
{
	private
		$comparison
	;

	function __construct(comparison\unary $comparison)
	{
		$this->comparison = $comparison;
	}

	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient) :void
	{
		$this->comparison
			->recipientOfComparisonWithOperandIs(
				$operand,
				new comparison\recipient\not($recipient)
			)
		;
	}
}
