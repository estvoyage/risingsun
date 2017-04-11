<?php namespace estvoyage\risingsun\time\clock\timestamp\unix;

use estvoyage\risingsun\{ time, time\duration\timestamp, ointeger };

class micro
	implements
		time\clock
{
	private
		$template
	;

	function __construct(timestamp\unix\micro $template = null)
	{
		$this->template = $template ?: new timestamp\unix\micro\any;
	}

	function recipientOfMicroUnixTimestampIs(timestamp\unix\micro\recipient $recipient)
	{
		$this->template
			->recipientOfOIntegerWithNIntegerIs(
				microtime(true) * 1000000,
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
