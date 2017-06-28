<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\{ ninteger, comparison, block\functor, block };

class pow extends ninteger\filter\type
	implements
		ninteger\operation\binary
{
	function recipientOfOperationOnNIntegersIs(int $firstOperand, int $secondOperand, ninteger\recipient $recipient)
	{
		(new comparison\unary\greaterThanOrEqualTo(0))
			->recipientOfComparisonWithOperandIs(
				$secondOperand,
				new comparison\recipient\functor\ok(
					function() use ($firstOperand, $secondOperand, $recipient)
					{
						$this
							->nIntegerRecipientForValueIs(
								pow($firstOperand, $secondOperand),
								$recipient
							)
						;
					}
				)
			)
		;
	}
}
