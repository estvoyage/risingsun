<?php namespace estvoyage\risingsun\comparison\unary\with\null;

use estvoyage\risingsun\comparison;

class type
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient)
	{
		$recipient->nbooleanIs($operand === null);
	}
}
