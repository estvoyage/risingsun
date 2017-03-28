<?php namespace estvoyage\risingsun\time;

use estvoyage\risingsun\time\duration\timestamp\unix;

interface clock
{
	function recipientOfMicroUnixTimestampIs(unix\micro\recipient $recipient);
}
