<?php namespace estvoyage\risingsun\time\clock;

use estvoyage\risingsun\{ time, time\duration\timestamp, ofloat, block\functor };

class unix
	implements
		time\clock
{
	private
		$operation
	;

	function __construct(ofloat\operation\unary $operation)
	{
		$this->operation = $operation;
	}

	function recipientOfMicroUnixTimestampIs(timestamp\unix\micro\recipient $recipient)
	{
		$this->operation
			->recipientOfOperationWithOFloatIs(
				new timestamp\unix\micro(microtime(true)),
				new functor(
					function($micro) use ($recipient)
					{
						$recipient->microUnixTimestampIs($micro);
					}
				)
			)
		;

		return $this;
	}
}
