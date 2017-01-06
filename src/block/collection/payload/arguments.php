<?php namespace estvoyage\risingsun\block\collection\payload;

use
	estvoyage\risingsun,
	estvoyage\risingsun\block
;

class arguments
	implements
		block\collection\payload
{
	private
		$arguments
	;

	function __construct(... $arguments)
	{
		$this->arguments = $arguments;
	}

	function currentBlockOfIteratorIs(risingsun\iterator $iterator, block $block)
	{
		$block->blockArgumentsAre(... $this->arguments);

		return $this;
	}
}
