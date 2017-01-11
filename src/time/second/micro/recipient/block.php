<?php namespace estvoyage\risingsun\time\second\micro\recipient;

use estvoyage\{ risingsun, risingsun\time };

class block
	implements
		time\second\micro\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function numberOfMicroSecondIs(time\second\micro $micro)
	{
		$this->block->blockArgumentsAre($micro);

		return $this;
	}
}
