<?php namespace estvoyage\risingsun\time\duration\timestamp\unix;

use estvoyage\risingsun\{ ofloat, nfloat, time\duration };

interface micro extends duration
{
	function recipientOfNFloatIs(nfloat\recipient $recipient);
	function recipientOfMicroUnixTimestampWithNFloatIs(float $float, micro\recipient $recipient);
}
