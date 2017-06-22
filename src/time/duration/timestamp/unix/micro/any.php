<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro;

use estvoyage\risingsun\{ ointeger, time\duration, ninteger };

class any extends ointeger\any
	implements
		duration\timestamp\unix\micro
{
	function recipientOfNumberOfSecondeIs(duration\seconde\recipient $recipient)
	{
		(new ointeger\operation\unary\division(new ointeger\any(1000000), new duration\seconde\any))
			->recipientOfOperationWithOIntegerIs(
				$this,
				new ointeger\recipient\functor(
					function($seconde) use ($recipient)
					{
						$recipient->secondeIs($seconde);
					}
				)
			)
		;
	}
}
