<?php namespace estvoyage\risingsun\comparison\unary\with\float;

use estvoyage\risingsun\comparison;

class type extends comparison\unary\with\true\boolean
{
	function operandForComparisonIs($value)
	{
		return parent::operandForComparisonIs(is_float($value));
	}
}
