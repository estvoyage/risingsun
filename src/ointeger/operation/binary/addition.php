<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ointeger\recipient, ointeger\operation\binary, block\functor, block };

class addition
	implements
		binary
{
	private
		$overflow
	;

	function __construct(block $overflow)
	{
		$this->overflow = $overflow;
	}

	function recipientOfOperationOnIntegersIs(ointeger $firstOperand, ointeger $secondOperand, ointeger\recipient $recipient)
	{
		$firstOperand->recipientOfNIntegerIs(
			new functor(
				function($firstOperandValue) use ($firstOperand, $secondOperand, $recipient)
				{
					$secondOperand->recipientOfNIntegerIs(
						new functor(
							function($secondOperandValue) use ($firstOperand, $firstOperandValue, $recipient)
							{
								$addition = $firstOperandValue + $secondOperandValue;

								if (is_float($addition))
								{
									$this->overflow->blockArgumentsAre();
								}
								else
								{
									$firstOperand->recipientOfOIntegerWithValueIs(
										$addition,
										$recipient
									);
								}
							}
						)
					);
				}
			)
		);

		return $this;
	}
}
