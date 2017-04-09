<?php namespace estvoyage\risingsun\time\duration\seconde\micro;

use estvoyage\risingsun\{ ointeger, time\duration, ninteger };

class any extends ointeger\any
	implements
		duration\seconde\micro
{
	function recipientOfOIntegerIs(ointeger\recipient $recipient)
	{
		$recipient->ointegerIs($this);

		return $this;
	}

	function recipientOfMicroSecondeWithOIntegerIs(ointeger $ointeger, duration\seconde\micro\recipient $recipient)
	{
		return $this
			->recipientOfOIntegerWithOIntegerIs(
				$ointeger,
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
