<?php namespace estvoyage\risingsun\comparison\unary\with\magic;

use estvoyage\risingsun\comparison;

class toString extends comparison\unary\with\true\boolean
{
	function operandForComparisonIs($operand)
	{
		return parent::operandForComparisonIs(is_object($operand) && method_exists($operand, '__toString'));
	}
}
