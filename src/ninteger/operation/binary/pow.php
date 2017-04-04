<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\{ ninteger, comparison, block\functor, block };

class pow
	implements
		ninteger\operation\binary
{
	private
		$overflow
	;

	function __construct(block $overflow = null)
	{
		$this->overflow = $overflow ?: new block\blackhole;
	}

	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, ninteger\recipient $recipient)
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
					function() use (& $pow, $recipient)
					{
						$recipient->nintegerIs($pow);
					}
				)
			)
		)
			->operandForComparisonIs(
				$pow = pow($firstOperand, $secondOperand)
			)
		;

		return $this;
	}
}
