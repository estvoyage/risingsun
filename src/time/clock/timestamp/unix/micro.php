<?php namespace estvoyage\risingsun\time\clock\timestamp\unix;

use estvoyage\risingsun\{ time, time\duration\timestamp, ofloat };

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
			->recipientOfMicroUnixTimestampWithNFloatIs(
				microtime(true),
				new timestamp\unix\micro\recipient\functor(
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
