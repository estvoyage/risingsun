<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro;

use estvoyage\risingsun\{ datum, time\duration\timestamp\unix as timestamp };

interface formater
{
	function recipientOfDatumForMicroUnixTimestampIs(timestamp\micro $timestamp, datum\recipient $recipient);
}
