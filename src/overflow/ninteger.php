<?php namespace estvoyage\risingsun\overflow;

use estvoyage\risingsun\{ overflow, comparison };

class ninteger
	implements
		overflow
{
	function recipientOfComparisonBetweenValueAndRangeIs($value, comparison\recipient $recipient)
	{
		(new comparison\unary\with\numeric\type)
			->recipientOfComparisonWithOperandIs(
				$value,
				new comparison\recipient\functor\ok(
					function() use ($value, $recipient)
					{
						$recipient->nbooleanIs($value === PHP_INT_MAX || $value === PHP_INT_MIN || is_int($value + ($value < 0 ? - 1 : 1)));
					}
				)
			)
		;
	}
}
