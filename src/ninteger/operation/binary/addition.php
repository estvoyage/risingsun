<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\ninteger\{ recipient, operation };

class addition extends operation\overflow
	implements
		operation\binary
{
	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient)
	{
		return $this
			->valueFromOperationWithNIntegerRecipientIs(
				$recipient,
				$firstOperand + $secondOperand
			)
		;
	}
}
