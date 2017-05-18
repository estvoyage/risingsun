<?php namespace estvoyage\risingsun\comparison\unary\with\magic;

use estvoyage\risingsun\comparison;

class toString
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient)
	{
		$recipient->nbooleanIs(is_object($operand) && method_exists($operand, '__toString'));
	}
}
