<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\{ ninteger\recipient, ninteger\operation, comparison, block\functor, oboolean, block };

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

	function recipientOfOperationWithNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient)
	{
		(new comparison\unary\with\float\type)
			->recipientOfComparisonWithValueIs(
				$addition = $firstOperand + $secondOperand,
				new oboolean\recipient\switching(
					new functor(
						function()
						{
							$this->overflow->blockArgumentsAre();
						}
					),
					new functor(
						function() use ($addition, $recipient)
						{
							$recipient->nintegerIs($addition);
						}
					)
				)
			)
		;

		return $this;
	}
}
