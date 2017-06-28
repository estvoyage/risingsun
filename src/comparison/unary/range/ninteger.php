<?php namespace estvoyage\risingsun\comparison\unary\range;

use estvoyage\risingsun\comparison;

class ninteger
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient)
	{
		(new comparison\unary\with\numeric\type)
			->recipientOfComparisonWithOperandIs(
				$operand,
				new comparison\recipient\functor\ok(
					function() use ($operand, $recipient)
					{
						$recipient->nbooleanIs($operand === PHP_INT_MAX || $operand === PHP_INT_MIN || is_int($operand + ($operand < 0 ? - 1 : 1)));
					}
				)
			)
		;
	}
}
