<?php namespace estvoyage\risingsun\time\duration\unix\timestamp;

use estvoyage\{ risingsun, risingsun\time };

class micro extends risingsun\ofloat\unsigned
	implements
		time\duration
{
	function recipientOfDifferenceWithMicroUnixTimestampIs(self $timestamp, time\duration\recipient $recipient)
	{
	}

	function recipientOfNumberOfSecondIs(time\second\recipient $recipient)
	{
	}

	function recipientOfNumberOfMicroSecondIs(time\second\micro\recipient $recipient)
	{
	}
}
