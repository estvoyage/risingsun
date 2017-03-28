<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro;

use estvoyage\risingsun\{ time\duration\timestamp\unix\micro, ofloat, block\functor };

class any extends ofloat\unsigned\any
	implements
		micro
{
	function recipientOfMicroUnixTimestampWithNFloatIs(float $float, micro\recipient $recipient)
	{
		$this
			->recipientOfOFloatWithNFloatIs(
				$float,
				new functor(
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
