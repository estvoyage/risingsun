<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger, ointeger\recipient, ointeger\operation\binary, block\functor };

class addition
	implements
		binary
{
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
								$firstOperand->recipientOfOIntegerWithValueIs(
									$firstOperandValue + $secondOperandValue,
									$recipient
								);
							}
						)
					);
				}
			)
		);

		return $this;
	}
}
