<?php namespace estvoyage\risingsun\time\duration;

use estvoyage\risingsun\ointeger;

interface seconde
{
	function recipientOfOIntegerIs(ointeger\recipient $recipient);
	function recipientOfSecondeWithOIntegerIs(ointeger $ointeger, seconde\recipient $recipient);
}
