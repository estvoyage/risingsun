<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\ninteger;

class addition extends ninteger\filter\type
	implements
		ninteger\operation\binary
{
	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, ninteger\recipient $recipient)
	{
		$this
			->nIntegerRecipientForValueIs(
				$firstOperand + $secondOperand,
				$recipient
			)
		;
	}
}
