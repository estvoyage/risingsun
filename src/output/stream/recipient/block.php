<?php namespace estvoyage\risingsun\output\stream\recipient;

use
	estvoyage\risingsun,
	estvoyage\risingsun\output
;

class block
	implements
		output\stream\recipient
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function outputStreamIs(output\stream $stream)
	{
		$this->block->blockArgumentsAre($stream);

		return $this;
	}
}
