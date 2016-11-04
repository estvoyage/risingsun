<?php namespace estvoyage\risingsun\oboolean;

use
	estvoyage\risingsun
;

class right extends risingsun\oboolean
{
	function ifTrue(risingsun\block $block) :risingsun\oboolean
	{
		$block->blockArgumentsAre();

		return $this;
	}

	function ifFalse(risingsun\block $block) :risingsun\oboolean
	{
		return $this;
	}
}
