<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro;

use estvoyage\risingsun\{ time\duration\timestamp\unix\micro, ofloat };

class any extends ofloat\unsigned\any
	implements
		micro
{
	function recipientOfMicroUnixTimestampWithNFloatIs(float $float, micro\recipient $recipient)
	{
		$this
			->recipientOfOFloatWithNFloatIs(
				$float,
				new ofloat\recipient\functor(
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
