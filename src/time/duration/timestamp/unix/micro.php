<?php namespace estvoyage\risingsun\time\duration\timestamp\unix;

use estvoyage\risingsun\{ ofloat, nfloat };

interface micro
{
	function recipientOfNFloatIs(nfloat\recipient $recipient);
	function recipientOfMicroUnixTimestampWithNFloatIs(float $float, micro\recipient $recipient);
}
