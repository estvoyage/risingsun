<?php namespace estvoyage\risingsun\comparison\unary\with\numeric;

use estvoyage\risingsun\comparison;

class type
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient) :void
	{
		$recipient->nbooleanIs(is_numeric($operand));
	}
}
