<?php namespace estvoyage\risingsun\comparison\unary\with\integer;

use estvoyage\risingsun\{ comparison, block };

class type
	implements
		comparison\unary
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok = null, block $ko = null)
	{
		$this->ok = $ok;
		$this->ko = $ko ?: new block\blackhole;
	}

	function operandForComparisonIs($value)
	{
		(
			new comparison\unary\numeric
			(
				new block\functor(
					function() use ($value)
					{
						(new comparison\binary\equal($this->ok, $this->ko))
							->referenceForComparisonWithOperandIs(
								$value,
								(int) $value
							)
						;
					}
				),
				$this->ko
			)
		)
			->operandForComparisonIs(
				$value
			)
		;

		return $this;
	}
}
