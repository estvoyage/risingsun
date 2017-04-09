<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro;

use estvoyage\risingsun\{ time\duration\timestamp\unix\micro, ofloat, ointeger };

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

	function recipientOfNumberOfDayIs(ointeger\unsigned\recipient $recipient)
	{
	}

	function recipientOfNumberOfHourIs(ointeger\unsigned\recipient $recipient)
	{
	}

	function recipientOfNumberOfMinuteIs(ointeger\unsigned\recipient $recipient)
	{
	}

	function recipientOfNumberOfSecondIs(ointeger\unsigned\recipient $recipient)
	{
	}

	function recipientOfNumberOfMicroSecondIs(ointeger\unsigned\recipient $recipient)
	{
	}
}
