<?php namespace estvoyage\risingsun\comparison\unary\with\float;

use estvoyage\risingsun\comparison;

class type
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient)
	{
		$recipient->nbooleanIs(is_float($operand));
	}
}
