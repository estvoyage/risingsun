<?php namespace estvoyage\risingsun\time\duration\seconde;

use estvoyage\risingsun\{ ointeger, time\duration };

class any extends ointeger\any
	implements
		duration\seconde
{
	function recipientOfNumberOfSecondeIs(duration\seconde\recipient $recipient)
	{
		$recipient->secondeIs($this);
	}
}
