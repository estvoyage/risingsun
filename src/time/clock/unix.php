<?php namespace estvoyage\risingsun\time\clock;

use estvoyage\risingsun\{ time, time\duration\timestamp, ofloat };

class unix
	implements
		time\clock
{
	private
		$template
	;

	function __construct(timestamp\unix\micro $template)
	{
		$this->template = $template;
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
