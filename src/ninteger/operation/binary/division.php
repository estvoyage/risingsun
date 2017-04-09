<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\{ ninteger\recipient, ninteger\operation, comparison, block };

class division
	implements
		operation\binary
{
	private
		$divisionByZero
	;

	function __construct(block $block = null)
	{
		$this->divisionByZero = $block ?: new block\blackhole;
	}

	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient)
	{
		(
			new comparison\unary\equal(
				0,
				$this->divisionByZero,
				new block\functor(
					function() use ($firstOperand, $secondOperand, $recipient)
					{
						$recipient->nintegerIs(intdiv($firstOperand, $secondOperand));
					}
				)
			)
		)
			->operandForComparisonIs(
				$secondOperand
			)
		;

		return $this;
	}
}
