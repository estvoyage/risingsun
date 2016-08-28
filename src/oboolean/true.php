<?php namespace estvoyage\risingsun\oboolean;

use
	estvoyage\risingsun
;

class true extends risingsun\oboolean
{
	function ifTrue(risingsun\block $block)
	{
		$block->blockArgumentsAre();

		return $this;
	}

	function ifFalse(risingsun\block $block)
	{
		return $this;
	}
}
