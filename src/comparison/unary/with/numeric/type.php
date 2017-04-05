<?php namespace estvoyage\risingsun\comparison\unary\with\numeric;

use estvoyage\risingsun\{ comparison, block };

class type extends comparison\unary\with\true\boolean
{
	function operandForComparisonIs($value)
	{
		return parent::operandForComparisonIs(is_numeric($value));
	}
}
