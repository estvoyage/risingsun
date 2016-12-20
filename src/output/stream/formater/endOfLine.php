<?php namespace estvoyage\risingsun\output\stream\formater;

use
	estvoyage\risingsun\block,
	estvoyage\risingsun\output,
	estvoyage\risingsun\ostring
;

class endOfLine implements output\stream\formater
{
	function recipientOfOutputStreamWithEndOfLineIs(output\stream $stream, output\stream\recipient $recipient)
	{
		$stream
			->recipientOfStringWithSuffixIs(
				new ostring\notEmpty(PHP_EOL),
				new ostring\recipient\block(
					new block\functor(
						function($stream) use ($recipient) {
							$recipient->outputStreamIs($stream);
						}
					)
				)
			)
		;

		return $this;
	}
}
