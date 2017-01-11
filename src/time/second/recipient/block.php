<?php namespace estvoyage\risingsun\time\second\recipient;

use estvoyage\{ risingsun, risingsun\time };

class block
	implements
		time\second\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function numberOfSecondIs(time\second $second)
	{
		$this->block->blockArgumentsAre($second);

		return $this;
	}
}
