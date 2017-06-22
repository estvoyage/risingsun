<?php namespace estvoyage\risingsun\time;

use estvoyage\risingsun\{ ointeger, time\duration\seconde };

interface duration extends ointeger
{
	function recipientOfNumberOfSecondeIs(seconde\recipient $recipient);
}
