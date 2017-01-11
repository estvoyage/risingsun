<?php namespace estvoyage\risingsun\time\duration\unix\timestamp\micro\recipient;

use estvoyage\{ risingsun, risingsun\time };

class block
	implements time\duration\unix\timestamp\micro\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function microUnixTimestampIs(time\duration\unix\timestamp\micro $timestamp)
	{
		$this->block->blockArgumentsAre($timestamp);

		return $this;
	}
}
