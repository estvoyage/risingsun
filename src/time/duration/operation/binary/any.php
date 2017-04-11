<?php namespace estvoyage\risingsun\time\duration\operation\binary;

use estvoyage\risingsun\{ time\duration, ointeger, ninteger, block };

class any extends ointeger\operation\binary\any
	implements
		duration\operation\binary
{
	function durationRecipientForOperationWithDurationAndDurationIs(duration $firstOperand, duration $secondOperand, duration\recipient $recipient)
	{
		return $this
			->recipientOfOperationOnOIntegersIs(
				$firstOperand,
				$secondOperand,
				new ointeger\recipient\functor(
					function($duration) use ($recipient)
					{
						$recipient->durationIs($duration);
					}
				)
			)
		;
	}
}
