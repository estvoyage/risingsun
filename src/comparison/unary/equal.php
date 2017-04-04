<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, block };

class equal
	implements
		comparison\unary
{
	private
		$reference,
		$comparison
	;

	function __construct($reference, block $ok, block $ko = null)
	{
		$this->reference = $reference;
		$this->comparison = new comparison\binary\equal($ok, $ko);
	}

	function operandForComparisonIs($operand)
	{
		$this->comparison
			->referenceForComparisonWithOperandIs(
				$operand,
				$this->reference
			)
		;

		return $this;
	}
}
