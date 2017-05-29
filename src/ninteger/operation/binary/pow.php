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
		(new comparison\unary\with\float\type)
			->recipientOfComparisonWithOperandIs(
				$pow = pow($firstOperand, $secondOperand),
				new comparison\recipient\switcher(
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
		;

		return $this;
	}
}
