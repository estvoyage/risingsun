<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun\block;

class aggregator
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko = null)
	{
		$this->ok = $ok;
		$this->ko = $ko ?: new block\blackhole;
	}

	function blockIs(block $block)
	{
		$block->blockArgumentsAre($this->ok, $this->ko);

		return $this;
	}
}
