<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary;

use estvoyage\risingsun\{ time\duration\timestamp\unix\micro as timestamp, ointeger };

class any extends ointeger\operation\binary\any
	implements
		timestamp\operation\binary
{
	function recipientOfOperationOnMicroUnixTimestampsIs(timestamp $firstOperand, timestamp $secondOperand, timestamp\recipient $recipient)
	{
		return $this
			->recipientOfOperationOnOIntegersIs(
				$firstOperand,
				$secondOperand,
				new ointeger\recipient\functor(
					function($timestamp) use ($recipient)
					{
						$recipient->microUnixTimestampIs($timestamp);
					}
				)
			)
		;

		return $this;
	}
}
