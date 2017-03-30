<?php namespace estvoyage\risingsun\time\duration\recipient;

use estvoyage\risingsun\{ time\duration, block };

class functor extends block\functor
	implements
		duration\recipient
{
	function durationIs(duration $duration)
	{
		return $this->blockArgumentsAre($duration);
	}
}
