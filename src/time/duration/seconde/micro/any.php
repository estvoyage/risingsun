<?php namespace estvoyage\risingsun\time\duration\seconde\micro;

use estvoyage\risingsun\{ ointeger, time\duration, ninteger };

class any extends ointeger\any
	implements
		duration\seconde\micro
{
	function recipientOfMicroSecondeWithNIntegerIs(int $ninteger, duration\seconde\micro\recipient $recipient)
	{
		return $this
			->recipientOfOIntegerWithNIntegerIs(
				$ninteger,
				new ointeger\recipient\functor(
					function($microSeconde) use ($recipient)
					{
						$recipient->microSecondeIs($microSeconde);
					}
				)
			)
		;
	}
}
