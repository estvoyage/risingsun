<?php namespace estvoyage\risingsun\time;

interface clock
{
	function recipientOfMicroUnixTimestampIs(duration\unix\timestamp\micro\recipient $recipient);
}
