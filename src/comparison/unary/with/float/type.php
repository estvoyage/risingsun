<?php namespace estvoyage\risingsun\comparison\unary\with\float;

use estvoyage\risingsun\{ comparison, block };

class type extends comparison\unary\switcher\boolean
	implements
		comparison\unary
{
	function operandForComparisonIs($value)
	{
		return $this
			->booleanForValueIs(
				$value,
				is_float($value)
			)
		;
	}
}
