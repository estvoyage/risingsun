<?php namespace estvoyage\risingsun\comparison\unary\with\integer;

use estvoyage\risingsun\{ comparison, block };

class type
	implements
		comparison\unary
{
	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient) :void
	{
		(new comparison\unary\with\numeric\type)
			->recipientOfComparisonWithOperandIs(
				$operand,
				new comparison\recipient\switcher(
					new block\functor(
						function() use ($operand, $recipient)
						{
							(new comparison\binary\equal)
								->recipientOfComparisonBetweenOperandAndReferenceIs(
									$operand,
									(int) $operand,
									$recipient
								)
							;
						}
					),
					new block\functor(
						function() use ($recipient)
						{
							$recipient->nbooleanIs(false);
						}
					)
				)
			)
		;
	}
}
