<?php namespace estvoyage\risingsun\comparison\recipient;

use estvoyage\risingsun\{ comparison, block };

class ok
	implements
		comparison\recipient
{
	private
		$block
	;

	function __construct(block $block)
	{
		$this->block = $block;
	}

	function nbooleanIs(bool $bool)
	{
		! $bool ?: $this->block->blockArgumentsAre();
	}
}
