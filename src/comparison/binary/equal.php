<?php namespace estvoyage\risingsun\comparison\binary;

use estvoyage\risingsun\{ comparison, block };

class equal
	implements
		comparison\binary
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko = null)
	{
		$this->ok = $ok;
		$this->ko = $ko ?: new block\blackhole;
	}

	function referenceForComparisonWithOperandIs($operand, $reference)
	{
		(
			new comparison\unary\with\true\boolean(
				$this->ok,
				$this->ko
			)
		)
			->operandForComparisonIs(
				$operand == $reference
			)
		;

		return $this;
	}
}
