<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, block };

class numeric extends with\true\boolean
{
	function operandForComparisonIs($value)
	{
		return parent::operandForComparisonIs(is_numeric($value));
	}
}
