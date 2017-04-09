<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\formater;

use estvoyage\risingsun\{ datum, time\duration\timestamp\unix as timestamp };

class human
	implements
		timestamp\micro\formater
{
	function recipientOfDatumForMicroUnixTimestampIs(timestamp\micro $timestamp, datum\recipient $recipient)
	{
		return $this;
	}
}
