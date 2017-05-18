<?php namespace estvoyage\risingsun\comparison\unary\with\ninteger;

use estvoyage\risingsun\{ comparison, block };

class type
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient)
	{
		$recipient->nbooleanIs(is_int($operand));
	}
}
