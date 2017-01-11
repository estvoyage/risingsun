<?php namespace estvoyage\risingsun\bench\block\controller;

use estvoyage\{ risingsun, risingsun\bench };

class block
	implements
		bench\block\controller
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function endOfBenchBlock()
	{
		$this->block->blockArgumentsAre();

		return $this;
	}
}
