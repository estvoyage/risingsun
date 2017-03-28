<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\recipient;

use estvoyage\risingsun\{ time\duration\timestamp\unix\micro, block };

class functor extends block\functor
	implements
		micro\recipient
{
	function microUnixTimestampIs(micro $timestamp)
	{
		return $this->blockArgumentsAre($timestamp);
	}
}
