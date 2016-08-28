<?php namespace estvoyage\risingsun\oboolean;

use
	estvoyage\risingsun
;

class false extends risingsun\oboolean
{
	function ifTrue(risingsun\block $block)
	{
		return $this;
	}

	function ifFalse(risingsun\block $block)
	{
		$block->blockArgumentsAre();

		return $this;
	}
}
