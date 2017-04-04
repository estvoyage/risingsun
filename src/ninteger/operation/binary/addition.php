<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\{ ninteger\recipient, ninteger\operation, comparison, block\functor, block };

class addition
	implements
		operation\binary
{
	private
		$overflow
	;

	function __construct(block $overflow = null)
	{
		$this->overflow = $overflow ?: new block\blackhole;
	}

	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient)
	{
		(
			new comparison\unary\with\float\type
			(
				new functor(
					function()
					{
						$this->overflow->blockArgumentsAre();
					}
				),
				new functor(
					function() use (& $addition, $recipient)
					{
						$recipient->nintegerIs($addition);
					}
				)
			)
		)
			->operandForComparisonIs(
				$addition = $firstOperand + $secondOperand
			)
		;

		return $this;
	}
}
